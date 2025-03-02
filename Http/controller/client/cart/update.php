<?php

use Core\App;
use Core\Database;
use Core\Services\ImageUploadService;
use Http\controller\dashboard\products\ProductsController;

$db = App::resolve(Database::class);
$cloudinary = App::resolve(ImageUploadService::class);
$controller = new ProductsController($db, $cloudinary);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $productId) {
                if (isset($_POST['action'])) {
                    switch ($_POST['action']) {
                        case 'increase':
                            $item['quantity'] = min($item['quantity'] + 1, $item['max_stock']);
                            break;
                        case 'decrease':
                            $item['quantity'] = max($item['quantity'] - 1, 1);
                            break;
                        case 'manual':
                            $newQuantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : $item['quantity'];
                            $item['quantity'] = max(1, min($newQuantity, $item['max_stock']));
                            break;
                    }
                }
                break;
            }
        }
    }
}
redirect('/cart');
exit();
