<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Services\ImageUploadService;

$container = new Container();


$container->bind('Core\Services\ImageUploadService', function () {
    $config = require base_path('config.php');

    return new ImageUploadService($config['cloudinary']);
});


$container->bind('Core\Database', function () {
    $databaseConfig = require base_path('config.php');
    return new Database($databaseConfig['database']);
});

App::setContainer($container);
