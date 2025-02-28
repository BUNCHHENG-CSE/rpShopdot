<?php

use Core\Database;
use Core\ProductController;
$config = require base_path('config.php')['database'];

$database = new Database($config);

$productController = new ProductController($database);
$products = $productController->index();

dd(afdsas);
view('dashboard/products/index.view.php', [
    'heading' => 'Products Management',
    'products' => $products
]);
