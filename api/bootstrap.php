<?php

// Create required directories
$directories = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
];

foreach ($directories as $directory) {
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

// Ensure proper permissions
chmod('/tmp/storage', 0777);
foreach ($directories as $directory) {
    chmod($directory, 0777);
}

// Create SQLite database if it doesn't exist
if (!file_exists('/tmp/database.sqlite')) {
    file_put_contents('/tmp/database.sqlite', '');
    chmod('/tmp/database.sqlite', 0777);
}