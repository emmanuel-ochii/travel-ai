# Use official PHP image with extensions for Laravel
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Copy .env example (optional)
RUN cp .env.example .env || true

# Generate Laravel key if missing
RUN php artisan key:generate --force || true

# Make start script executable
RUN chmod +x start.sh

# Expose port 8080
EXPOSE 8080

# Start Laravel with custom script
CMD ["./start.sh"]
