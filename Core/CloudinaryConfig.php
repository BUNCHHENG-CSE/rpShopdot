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
            ],
            'logging' => [
                'level' => 'debug'
            ],
            'curl_options' => [
            CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0
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
                error_log("Missing Cloudinary credential: $var");
                throw new \RuntimeException("Missing Cloudinary credential: $var");
            }
        }

        if (strlen($_ENV['CLOUDINARY_API_KEY']) < 10) {
            error_log("Invalid Cloudinary API Key");
            throw new \RuntimeException("Invalid Cloudinary API Key");
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
