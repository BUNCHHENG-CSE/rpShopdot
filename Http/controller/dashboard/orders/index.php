<?php

namespace Http\controller\dashboard\orders;

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$controller = new OrdersController($db);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/tborders' && $method === 'GET') {
    $controller->index();
} elseif ($uri === '/tborders' && $method === 'POST') {
    if (!isset($_POST['order_id'])) {
        $controller->store($_POST);
    }
} elseif ($uri === '/tborders/update' && $method === 'POST') {
    $controller->update($_POST);
} elseif ($uri === '/tborders/delete' && $method === 'POST') {
    $controller->destroy($_POST);
}
