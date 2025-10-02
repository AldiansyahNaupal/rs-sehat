#!/bin/bash

# Build script for deployment
echo "🚀 Starting deployment build..."

# Install dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader

echo "📦 Installing NPM dependencies..."
npm ci

echo "🎨 Building assets..."
npm run build

# Setup Laravel
echo "⚙️ Setting up Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🗄️ Running migrations..."
php artisan migrate --force

echo "✅ Build completed successfully!"
