<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/products', 'products/index.php');
$router->get('/cart', 'cart/index.php');
