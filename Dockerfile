# Use official PHP image with extensions for Laravel
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev libicu-dev nodejs npm \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Copy .env example
RUN cp .env.example .env || true

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel key
RUN php artisan key:generate --force || true

# Install Node dependencies and build Vite assets
RUN npm install
RUN npm run build

# Make start script executable
RUN chmod +x start.sh

# Expose port for Render
EXPOSE 8080

# Start Laravel with custom script
CMD ["./start.sh"]
