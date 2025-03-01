<?php

use Core\App;
use Core\Database;
use Core\Services\ImageUploadService;
use Http\controller\dashboard\products\ProductsController;

$db = App::resolve(Database::class);
$cloudinary = App::resolve(ImageUploadService::class);
$controller = new ProductsController($db, $cloudinary);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('/^\/product\/(\d+)$/', $uri, $matches) && $method === 'GET') {
    $productId = $matches[1];
    $controller->showOneProduct(['product_id' => $productId]);
}
