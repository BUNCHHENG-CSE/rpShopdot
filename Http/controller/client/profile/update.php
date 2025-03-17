<?php

use Core\App;
use Core\Database;
use Core\Services\ImageUploadService;
use Http\controller\client\profile\ProfileController;

$db = App::resolve(Database::class);
$cloudinary = App::resolve(ImageUploadService::class);
$controller = new ProfileController($db, $cloudinary);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/profile/update' && $method === 'POST') {
    $controller->update($_POST);
}
