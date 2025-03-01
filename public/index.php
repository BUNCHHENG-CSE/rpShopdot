<?php

// use Core\Session;
// use Core\ValidationException;
use Dotenv\Dotenv;

const BASE_PATH = __DIR__ . "/../";
require  __DIR__ . '/../vendor/autoload.php';
session_start();
require BASE_PATH . 'Core/function.php';
require base_path("bootstrap.php");


$router = new Core\Router();

$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);

// try {
//     $router->route($uri, $method);
// } catch (ValidationException $exception) {
//     Session::flash('errors', $exception->errors);
//     Session::flash('old', $exception->old);

//     return redirect($router->previousUrl());
// }
// Session::unflash();
