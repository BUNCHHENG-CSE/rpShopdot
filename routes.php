<?php

// Client Interface

$router->get('/', 'client/index.php');
$router->get('/about', 'client/about.php');
$router->get('/contact', 'client/contact.php');

$router->get('/products', 'client/products/index.php');
$router->get('/cart', 'client/cart/index.php');


// Admin Interface

$router->get('/dashboard', 'dashboard/index.php');
$router->get('/table', 'dashboard/table.php');
$router->get('/billing', 'dashboard/billing.php');
$router->get('/profile', 'dashboard/profile.php');
// $router->get('/tbproducts', 'dashboard/products/index.php');
$router->get('/tbcategories', 'dashboard/categories/index.php');
$router->get('/tbusers', 'dashboard/users/index.php');
$router->get('/tborders', 'dashboard/orders/index.php');
//product
$router->get('/tbproducts', 'dashboard/products/index.php');
$router->post('/tbproducts', 'dashboard/products/index.php');
$router->post('/tbproducts/{id}', 'dashboard/products/index.php');
$router->post('/tbproducts/{id}/delete', 'dashboard/products/index.php');
