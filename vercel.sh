#!/bin/bash

echo "🚀 Running Vercel build script..."

# PHP dependency installation
composer install --no-dev --optimize-autoloader

# Copy production environment file
cp .env.production .env

# Generate app key if not set
php artisan key:generate --force

# Storage directory setup
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 777 storage

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install and build frontend assets
npm install
npm run build

echo "✅ Build completed successfully!"