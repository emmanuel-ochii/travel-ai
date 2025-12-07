# Use official PHP image with extensions for Laravel
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libonig-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port for Render
EXPOSE 8080

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=8080
