<?php

use Core\App;
use Core\Database;
use Http\controller\dashboard\users\UserController;

$db = App::resolve(Database::class);
$imageUploadService = new \Core\Services\ImageUploadService();
$controller = new UserController($db, $imageUploadService);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/register' && $method === 'POST') {
    if (!isset($_POST['user_id'])) {
        $controller->store($_POST);
    }
}
