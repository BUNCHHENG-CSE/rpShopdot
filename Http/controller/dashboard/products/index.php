<?php

namespace Http\Controller\Dashboard\Products;

use Core\App;
use Core\Database;
use Core\Validator;
use Core\ValidationException;
use Core\Services\ImageUploadService;

class ProductController
{
    protected $db;
    protected $imageUploadService;

    public function __construct(Database $db, ImageUploadService $imageUploadService)
    {
        $this->db = $db;
        $this->imageUploadService = $imageUploadService;
    }

    public function index()
    {
        $products = $this->db->query("
            SELECT p.*, c.category_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
        ")->get();

        view('dashboard/products/index.view.php', [
            'heading' => 'Products',
            'products' => $products,
            'categories' => $this->db->query("SELECT * FROM categories")->get()
        ]);
    }

    public function store($request)
    {
        $errors = [];

        if (!Validator::string($request['product-name'], 2, 255)) {
            $errors['product-name'] = 'Product name must be between 2 and 255 characters.';
        }

        if (!Validator::greaterThan((int)$request['product-stock'], -1)) {
            $errors['product-stock'] = 'Stock must be a non-negative number.';
        }

        if (!Validator::greaterThan((float)$request['product-price'], 0)) {
            $errors['product-price'] = 'Price must be greater than zero.';
        }

        $imageUrl = null;
        if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
            try {
                $this->imageUploadService->validateImageFile($_FILES['product-image']);
                $uploadResult = $this->imageUploadService->uploadImage($_FILES['product-image']['tmp_name']);
                $imageUrl = $uploadResult['secure_url'];
            } catch (\Exception $e) {
                $errors['product-image'] = $e->getMessage();
            }
        }

        if (!empty($errors)) {
            ValidationException::throw($errors, $request);
        }

        $this->db->query("
            INSERT INTO products (name, description, price, stock, category_id, image_url)
            VALUES (?, ?, ?, ?, ?, ?)", [
            $request['product-name'],
            $request['product-decription'],
            $request['product-price'],
            $request['product-stock'],
            $request['product-category'],
            $imageUrl
        ]);

        redirect('/tbproducts');
    }

    public function update($id, $request)
    {
        $product = $this->db->query("SELECT * FROM products WHERE product_id = ?", [$id])->findOrFail();
        dd($product);
        die();
        $errors = [];

        if (!Validator::string($request['product-name'], 2, 255)) {
            $errors['product-name'] = 'Product name must be between 2 and 255 characters.';
        }

        $imageUrl = $product['image_url'];
        if (isset($_FILES['product-image']) && $_FILES['product-image']['error'] === UPLOAD_ERR_OK) {
            try {
                $this->imageUploadService->validateImageFile($_FILES['product-image']);
                $uploadResult = $this->imageUploadService->uploadImage($_FILES['product-image']['tmp_name']);
                $imageUrl = $uploadResult['secure_url'];
            } catch (\Exception $e) {
                $errors['product-image'] = $e->getMessage();
            }
        }

        if (!empty($errors)) {
            ValidationException::throw($errors, $request);
        }

        $this->db->query("
            UPDATE products
            SET name = ?,
                description = ?,
                price = ?,
                stock = ?,
                category_id = ?,
                image_url = ?
            WHERE product_id = ?", [
            $request['product-name-update'],
            $request['product-decription-update'],
            $request['product-price-update'],
            $request['product-stock-update'],
            $request['product-category-update'],
            $imageUrl,
            $id
        ]);

        redirect('/tbproducts');
    }

    public function destroy($id)
    {
        $product = $this->db->query("SELECT * FROM products WHERE product_id = ?", [$id])->findOrFail();

        $this->db->query("DELETE FROM products WHERE product_id = ?", [$id]);

        redirect('/tbproducts');
    }
}

// $container = new \Core\Container();
$db = App::resolve(Database::class);
$imageUploadService = new \Core\Services\ImageUploadService();
$controller = new ProductController($db, $imageUploadService);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/tbproducts' && $method === 'GET') {
    $controller->index();
} elseif ($uri === '/tbproducts' && $method === 'POST') {
    $controller->store($_POST);
} elseif (preg_match('/^\/tbproducts\/(\d+)$/', $uri, $matches) && $method === 'POST') {
    $controller->update($_POST['id'], $_POST);
} elseif (preg_match('/^\/tbproducts\/(\d+)\/delete$/', $uri, $matches) && $method === 'POST') {
    $controller->destroy($matches[1]);
    redirect('/tbproducts');
}
