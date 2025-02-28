<?php

namespace Core\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class ImageUploadService
{
    private $cloudinary;
    private $uploadApi;

    public function __construct()
    {
        try {

            $cloudName = $_ENV['CLOUDINARY_CLOUD_NAME'] ?? '';
            $apiKey = $_ENV['CLOUDINARY_API_KEY'] ?? '';
            $apiSecret = $_ENV['CLOUDINARY_API_SECRET'] ?? '';


            $this->validateCredentials($cloudName, $apiKey, $apiSecret);


            $configuration = new Configuration([
                'cloud' => [
                    'cloud_name' => $cloudName,
                    'api_key' => $apiKey,
                    'api_secret' => $apiSecret
                ],
                'url' => [
                    'secure' => true
                ]
            ]);


            $this->cloudinary = new Cloudinary($configuration);


            $this->uploadApi = new UploadApi($configuration);
        } catch (\Exception $e) {

            error_log('Cloudinary Initialization Error: ' . $e->getMessage());
            throw new \RuntimeException('Failed to initialize Cloudinary: ' . $e->getMessage());
        }
    }


    public function validateImageFile($file)
    {

        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new \InvalidArgumentException('No file uploaded or upload error occurred');
        }


        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxFileSize) {
            throw new \InvalidArgumentException("File too large. Maximum {$maxFileSize} bytes allowed.");
        }
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new \InvalidArgumentException('Invalid file type. Only JPEG, PNG, and WebP are allowed.');
        }
    }


    public function uploadImage($filePath, $options = [])
    {

        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException('File does not exist: ' . $filePath);
        }


        $defaultOptions = [
            'folder' => 'products',
            'overwrite' => true,
            'resource_type' => 'image',
            'transformation' => [
                ['width' => 800, 'height' => 600, 'crop' => 'limit']
            ]
        ];


        $uploadOptions = array_merge($defaultOptions, $options, [
            'curl_options' => [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0
            ]
        ]);
        try {

            $uploadResult = $this->uploadApi->upload($filePath, $uploadOptions);


            error_log('Cloudinary Upload Successful. Public ID: ' . $uploadResult['public_id']);

            return $uploadResult;
        } catch (\Exception $e) {

            error_log('Cloudinary Upload Error: ' . $e->getMessage());
            error_log('File Path: ' . $filePath);
            error_log('Upload Options: ' . json_encode($uploadOptions));


            throw new \RuntimeException(
                'Image upload to Cloudinary failed: ' . $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
    }

    private function validateCredentials($cloudName, $apiKey, $apiSecret)
    {
        $missingCredentials = [];

        if (empty($cloudName)) $missingCredentials[] = 'Cloud Name';
        if (empty($apiKey)) $missingCredentials[] = 'API Key';
        if (empty($apiSecret)) $missingCredentials[] = 'API Secret';

        if (!empty($missingCredentials)) {
            $missingList = implode(', ', $missingCredentials);
            throw new \InvalidArgumentException("Missing Cloudinary credentials: $missingList");
        }
    }
}
