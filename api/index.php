<?php

// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Create storage and bootstrap/cache directories if they don't exist
if (!file_exists(__DIR__ . '/../storage')) {
    mkdir(__DIR__ . '/../storage');
    mkdir(__DIR__ . '/../storage/app');
    mkdir(__DIR__ . '/../storage/framework');
    mkdir(__DIR__ . '/../storage/framework/cache');
    mkdir(__DIR__ . '/../storage/framework/sessions');
    mkdir(__DIR__ . '/../storage/framework/views');
    mkdir(__DIR__ . '/../storage/logs');
}

if (!file_exists(__DIR__ . '/../bootstrap/cache')) {
    mkdir(__DIR__ . '/../bootstrap/cache', 0777, true);
}

// Forward the request to Laravel
require __DIR__ . '/../public/index.php';
