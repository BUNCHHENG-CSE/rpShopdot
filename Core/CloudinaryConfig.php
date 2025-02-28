<?php
namespace Core;

use Cloudinary\Configuration\Configuration;
use Dotenv\Dotenv;

class CloudinaryConfig {
    private static $instance = null;
    private $configuration;

    private function __construct() {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
        $this->validateCredentials();
        $this->configuration = new Configuration([
            'cloud' => [
                'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
                'api_key' => $_ENV['CLOUDINARY_API_KEY'],
                'api_secret' => $_ENV['CLOUDINARY_API_SECRET']
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }
    private function validateCredentials() {
        $requiredVars = [
            'CLOUDINARY_CLOUD_NAME',
            'CLOUDINARY_API_KEY',
            'CLOUDINARY_API_SECRET'
        ];

        foreach ($requiredVars as $var) {
            if (empty($_ENV[$var])) {
                throw new \RuntimeException("Missing Cloudinary credential: $var");
            }
        }
    }
    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConfiguration() {
        return $this->configuration;
    }
}