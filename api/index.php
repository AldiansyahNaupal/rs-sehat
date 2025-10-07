<?php

// Bootstrap Vercel setup
require __DIR__ . '/bootstrap.php';

// Load Composer's autoloader
require __DIR__ . '/../vendor/autoload.php';

// Load environment file
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Set storage path
$app->useStoragePath('/tmp/storage');

// Run the application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
