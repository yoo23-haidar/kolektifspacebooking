#!/bin/bash
set -e

# Generate app key if not set
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Create storage link
php artisan storage:link 2>/dev/null || true

# Clear old caches first
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Rebuild caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Run seeders only if database is empty
php artisan db:seed --force 2>/dev/null || echo "Seeding skipped (data already exists)"

# Start server
exec "$@"
