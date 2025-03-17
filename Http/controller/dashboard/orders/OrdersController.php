<?php

namespace Http\controller\dashboard\orders;

use Core\Database;
use Core\Validator;
use Core\ValidationException;

class OrdersController
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function index()
    {
        $orders = $this->db->query("
            SELECT o.*, u.name AS user_name, 
                   COUNT(oi.order_item_id) AS total_items
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.user_id
            LEFT JOIN order_items oi ON o.order_id = oi.order_id
            GROUP BY o.order_id
            ORDER BY o.created_at DESC
        ")->get();

        view('dashboard/orders/index.view.php', [
            'heading' => 'Orders',
            'orders' => $orders
        ]);
    }

    public function show($orderId)
    {
        // Fetch order details with items
        $order = $this->db->query("
            SELECT o.*, u.name AS user_name, u.email AS user_email
            FROM orders o
            LEFT JOIN users u ON o.user_id = u.user_id
            WHERE o.order_id = ?
        ", [$orderId])->findOrFail();

        $orderItems = $this->db->query("
            SELECT oi.*, p.name AS product_name, p.image_url AS product_image
            FROM order_items oi
            JOIN products p ON oi.product_id = p.product_id
            WHERE oi.order_id = ?
        ", [$orderId])->get();

        return [
            'order' => $order,
            'items' => $orderItems
        ];
    }
    public function store($request) {}
    public function update($request)
    {
        $errors = [];
        $orderId = $request['order_id'];
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        if (!in_array($request['status'], $validStatuses)) {
            $errors['status'] = 'Invalid order status.';
        }

        if (!empty($errors)) {
            ValidationException::throw($errors, $request);
        }
        $this->db->query("
            UPDATE orders 
            SET status = ? 
            WHERE order_id = ?
        ", [$request['status'], $orderId]);

        redirect('/tborders');
    }

    public function destroy($request)
    {
        $id = $request['order_id'];
        $order = $this->db->query("SELECT * FROM orders WHERE order_id = ?", [$id])->findOrFail();
        $this->db->query("DELETE FROM order_items WHERE order_id = ?", [$id]);
        $this->db->query("DELETE FROM orders WHERE order_id = ?", [$id]);
        redirect('/tborders');
    }
}
