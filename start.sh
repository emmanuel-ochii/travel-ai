#!/bin/bash

# Run Laravel Commands
php artisan migrate --force || true
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan config:cache
php artisan route:cache

# Start Laravel
php artisan serve --host=0.0.0.0 --port=8080
