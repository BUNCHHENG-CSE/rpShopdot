<?php

namespace Http\controller\dashboard\products;

use Core\App;
use Core\Database;



$db = App::resolve(Database::class);
$imageUploadService = new \Core\Services\ImageUploadService();
$controller = new ProductsController($db, $imageUploadService);


$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/tbproducts' && $method === 'GET') {
    $controller->index();
} elseif ($uri === '/tbproducts' && $method === 'POST') {
    if (!isset($_POST['product_id'])) {
        $controller->store($_POST);
    }
} elseif ($uri === '/tbproducts/update' && $method === 'POST') {
    $controller->update($_POST);
} elseif ($uri === '/tbproducts/delete' && $method === 'POST') {
    $controller->destroy($_POST);
}
