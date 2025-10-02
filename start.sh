#!/bin/bash

# Install dependencies
composer install --no-dev --optimize-autoloader
npm ci
npm run build

# Setup directories and permissions
mkdir -p storage/framework/{sessions,views,cache}
chmod -R 777 storage bootstrap/cache public

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Generate key if not exists
php artisan key:generate --force

# Run migrations and seeders
php artisan migrate:fresh --force --seed

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link || true

# Start server
php artisan serve --host=0.0.0.0 --port=$PORT