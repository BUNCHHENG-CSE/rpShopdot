<?php

use Core\App;
use Core\Services\ImageUploadService;

$cloudinary = App::resolve(ImageUploadService::class);

header('Content-Type: application/json');

try {
    if (!isset($_FILES['profile_image']) || $_FILES['profile_image']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode([
            'success' => false,
            'message' => 'No file uploaded'
        ]);
        exit;
    }

    $cloudinary->validateImageFile($_FILES['profile_image']);
    $uploadResult = $cloudinary->uploadImage($_FILES['profile_image']['tmp_name'], [
        'folder' => 'profile_images',
        'transformation' => [
            ['width' => 500, 'height' => 500, 'crop' => 'fill']
        ]
    ]);

    echo json_encode([
        'success' => true,
        'image_url' => $uploadResult['secure_url']
    ]);
    exit;
} catch (\Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
    exit;
}
