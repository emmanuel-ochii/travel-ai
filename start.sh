#!/bin/bash

echo "🚀 Running Laravel Production Init..."

php artisan migrate --force || true

# Clear caches and rebuild optimized cache
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✔ Laravel Ready. Starting server..."

# Start Laravel on Render's required port
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
