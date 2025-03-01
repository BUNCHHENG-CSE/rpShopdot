<?php

namespace Core;

use Cloudinary\Configuration\Configuration;


class CloudinaryConfig
{
    private static $instance = null;
    private $configuration;

    private function __construct()
    {
        $this->validateCredentials();
        $this->configuration = new Configuration([
            'cloud' => [
                'cloud_name' => getenv('CLOUDINARY_CLOUD_NAME'),
                'api_key' =>  getenv('CLOUDINARY_API_KEY'),
                'api_secret' => getenv('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }
    private function validateCredentials()
    {
        $requiredVars = [
            getenv('CLOUDINARY_CLOUD_NAME'),
            getenv('CLOUDINARY_API_KEY'),
            getenv('CLOUDINARY_API_SECRET')

        ];

        foreach ($requiredVars as $var) {
            if (empty($_ENV[$var])) {
                throw new \RuntimeException("Missing Cloudinary credential: $var");
            }
        }
    }
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }
}
