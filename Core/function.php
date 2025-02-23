<?php



function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
function abort($code = 404)
{
    http_response_code($code);

    return require base_path("views/{$code}.php");


    die();
}
function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}


function base_path($path)
{
    return BASE_PATH . $path;
}
function view($path, $attributes = [])
{
    //extract($attributes);
    require base_path("views/{$path}");
}
function redirect($path)
{
    header("Location: {$path}");
    exit();
}
