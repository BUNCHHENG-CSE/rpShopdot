<?php

namespace Core;

use Cloudinary\Configuration\Configuration;
use Dotenv\Dotenv;

class CloudinaryConfig
{
    private static $instance = null;
    private $configuration;

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotenv->load();
        $this->validateCredentials();
        $this->configuration = new Configuration([
            'cloud' => [
                'cloud_name' => 'dhwfvi0qd',
                'api_key' => '164873255923774',
                'api_secret' => '6nFdKCexRwD9i5SEpueEr14DMXw',
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }
    private function validateCredentials()
    {
        $requiredVars = [
            'dhwfvi0qd',
            '164873255923774',
            '6nFdKCexRwD9i5SEpueEr14DMXw',
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
