<?php

use Core\App;
use Core\Container;
use Core\Database;
<<<<<<< HEAD
=======

>>>>>>> 8230641a5b2f6adea01b617796d73f1fee4a6c57
$container = new Container();

$container->bind('Core\Database', function () {
    $databaseConfig = require base_path('config.php');
    return new Database($databaseConfig['database']);
});
App::setContainer($container);
