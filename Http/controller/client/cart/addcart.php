<?php

use Core\App;
use Core\Database;
use Core\Services\ImageUploadService;
use Http\controller\dashboard\products\ProductsController;

$db = App::resolve(Database::class);
$cloudinary = App::resolve(ImageUploadService::class);
$controller = new ProductsController($db, $cloudinary);

$uri = $_SERVER['REQUEST_URI'];
$id = basename($uri);

if (is_numeric($id)) {
    $products = $controller->showOneProductAddCart($id);
     //dd(json_encode(['id' => $products['product_id'], 'name' => $products['name'], 'price' => $products['price'], 'image' => $products['image_url']]));
    // //setcookie('product_in_cart', json_encode(['id' => $products->id, 'name' => $products->name, 'price' => $products->price, 'image' => $products->image]), time() + 3600, '/');

} else {
    header("Location: /products");
    exit();
}
