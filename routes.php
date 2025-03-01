<?php

/**** Client Interface */

$router->get('/', 'client/index.php');
$router->get('/about', 'client/about.php');
$router->get('/contact', 'client/contact.php');

$router->get('/products', 'client/products/index.php');
$router->get('/product/{id}', 'client/products/show.php');
$router->get('/cart', 'client/cart/index.php');
$router->get('/profile', 'client/profile/index.php');

// user regisration
$router->post('/register', 'client/registration/index.php');
$router->post('/login', 'client/login/index.php');
$router->post('/logout', 'client/login/destroy.php');
/**** Admin Interface */

$router->get('/dashboard', 'dashboard/index.php')->only('superuser');

//product dashboard
$router->get('/tbproducts', 'dashboard/products/index.php');
$router->post('/tbproducts', 'dashboard/products/index.php');
$router->post('/tbproducts/update', 'dashboard/products/index.php');
$router->post('/tbproducts/delete', 'dashboard/products/index.php');

//category dashboard
$router->get('/tbcategories', 'dashboard/categories/index.php');
$router->post('/tbcategories', 'dashboard/categories/index.php');
$router->post('/tbcategories/update', 'dashboard/categories/index.php');
$router->post('/tbcategories/delete', 'dashboard/categories/index.php');

// order dashboard
$router->get('/tborders', 'dashboard/orders/index.php');
$router->post('/tborders', 'dashboard/orders/index.php');
$router->post('/tborders/update', 'dashboard/orders/index.php');
$router->post('/tborders/delete', 'dashboard/orders/index.php');

// user dashboard

$router->get('/tbusers', 'dashboard/users/index.php');
$router->post('/tbusers/update', 'dashboard/users/index.php');
$router->post('/tbusers/delete', 'dashboard/users/index.php');
