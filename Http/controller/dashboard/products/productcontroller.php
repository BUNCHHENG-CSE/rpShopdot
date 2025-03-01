<?php

// namespace Core;

// use PDO;
// use Core\Services\ImageUploadService;

// class ProductController
// {
//     private $database;
//     private $imageUploadService;

//     public function __construct(Database $database, ImageUploadService $imageUploadService)
//     {
//         $this->database = $database;
//         $this->imageUploadService = $imageUploadService;
//     }
//     public function index()
//     {
//         $query = "SELECT
//                       product_id,
//                       name,
//                       description,
//                       price,
//                       category_id,
//                       stock,
//                       image_url
//                       FROM products
//                       ORDER BY created_at DESC";
//         error_log("Product Query: " . $query);

//         $stmt = $this->database->conncetion->prepare($query);
//         $stmt->execute();
//         $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
//         error_log("Products Found: " . count($products));

//         if (!empty($products)) {
//             error_log("First Product: " . print_r($products[0], true));
//         }
//         return $products;
//     }
//     private function uploadProductImage($imageFile)
//     {
//         try {
//             $this->imageUploadService->validateImageFile($imageFile);
//             $uploadOptions = [
//                 'folder' => 'products',
//                 'transformation' => [
//                     ['width' => 800, 'height' => 600, 'crop' => 'limit']
//                 ]
//             ];
//             $uploadResult = $this->imageUploadService->uploadImage(
//                 $imageFile['tmp_name'],
//                 $uploadOptions
//             );
//             return $uploadResult['secure_url'] ?? null;
//         } catch (\Exception $e) {
//             error_log('Product image upload failed: ' . $e->getMessage());
//             return null;
//         }
//     }

//     public function create($data)
//     {

//         if (isset($data['image']) && $data['image']['error'] === UPLOAD_ERR_OK) {
//             $imageUrl = $this->uploadProductImage($data['image']);
//             if ($imageUrl) {
//                 $data['image_url'] = $imageUrl;
//             }
//         }
//         unset($data['image']);
//         //$errors = $this->validateProductData($data);
//         if (!empty($errors)) {
//             return ['success' => false, 'errors' => $errors];
//         }

//         $query = "INSERT INTO products
//                   (name, description, price, category_id, stock, image_url)
//                   VALUES
//                   (:name, :description, :price, :category_id, :stock, :image_url)";
//         $productData = [
//             'name' => trim($data['name']),
//             'description' => trim($data['description']),
//             'price' => floatval($data['price']),
//             'category_id' => intval($data['category_id']),
//             'stock' => intval($data['stock']),
//             'image_url' => $data['image_url'] ?? null
//         ];

//         try {
//             $this->database->query($query, $productData);
//             return [
//                 'success' => true,
//                 'product_id' => $this->database->conncetion->lastInsertId()
//             ];
//         } catch (\Exception $e) {
//             return [
//                 'success' => false,
//                 'error' => 'Failed to create product: ' . $e->getMessage()
//             ];
//         }
//     }
//     public function update($productId, $data)
//     {
//         //$existingProduct = $this->show($productId);
//         // if (!$existingProduct) {
//         //     return ['success' => false, 'error' => 'Product not found'];
//         // }
//         if (isset($data['image']) && $data['image']['error'] === UPLOAD_ERR_OK) {
//             $imageUrl = $this->uploadProductImage($data['image']);
//             if ($imageUrl) {
//                 $data['image_url'] = $imageUrl;
//             }
//         }
//         unset($data['image']);
//         //$errors = $this->validateProductData($data);
//         if (!empty($errors)) {
//             return ['success' => false, 'errors' => $errors];
//         }
//         $query = "UPDATE products
//                   SET name = :name,
//                       description = :description,
//                       price = :price,
//                       category_id = :category_id,
//                       stock = :stock,
//                       image_url = COALESCE(:image_url, image_url)
//                   WHERE product_id = :id";
//         $productData = [
//             'id' => $productId,
//             'name' => trim($data['name']),
//             'description' => trim($data['description']),
//             'price' => floatval($data['price']),
//             'category_id' => intval($data['category_id']),
//             'stock' => intval($data['stock']),
//             'image_url' => $data['image_url'] ?? null
//         ];

//         try {
//             $this->database->query($query, $productData);
//             return ['success' => true];
//         } catch (\Exception $e) {
//             return [
//                 'success' => false,
//                 'error' => 'Failed to update product: ' . $e->getMessage()
//             ];
//         }
//     }
// }
