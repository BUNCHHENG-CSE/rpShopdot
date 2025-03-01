<?php

use Core\App;
use Core\Database;
use Core\Services\ImageUploadService;
use Http\controller\dashboard\products\ProductsController;

$db = App::resolve(Database::class);
$cloudinary = App::resolve(ImageUploadService::class);
$controller = new ProductsController($db, $cloudinary);

// Extract the product ID from the URL
$uri = $_SERVER['REQUEST_URI'];
$id = basename($uri);

if (is_numeric($id)) {
    $controller->showOneProduct($id);
} else {
    // Handle invalid product ID (e.g., redirect or show an error)
    header('Location: /products');
    exit();
}
