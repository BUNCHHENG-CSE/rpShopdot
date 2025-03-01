<?php

use Core\App;
use Core\Database;
use Core\ProductController;

//$config = require base_path('config.php')['database'];

//$database = new Database($config);
$database = App::resolve(Database::class);
$productController = new ProductController($database);
$products = $productController->index();

view('dashboard/products/index.view.php', [
    'heading' => 'Products',
    'products' => $products
]);
