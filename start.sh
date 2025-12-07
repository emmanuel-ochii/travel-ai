#!/bin/bash

# Laravel setup
php artisan migrate --force || true
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan config:cache
php artisan route:cache

# Start server on the correct port
php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
