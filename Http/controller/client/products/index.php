<?php

use Core\App;
use Core\Database;
use Http\controller\dashboard\products\ProductsController;

$db = App::resolve(Database::class);
$imageUploadService = new \Core\Services\ImageUploadService();
$controller = new ProductsController($db, $imageUploadService);


$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/products' && $method === 'GET') {
    $controller->index('client');
}
