# Use official PHP FPM image
FROM php:8.2-fpm

WORKDIR /var/www/html

# Install extensions
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libonig-dev libpng-dev libjpeg-dev libfreetype6-dev libicu-dev nginx supervisor \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy code
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# Copy .env
RUN cp .env.example .env || true
RUN php artisan key:generate --force || true

# Copy Nginx config
COPY ./docker/nginx.conf /etc/nginx/sites-available/default

# Expose port 8080
EXPOSE 8080

# Start Supervisor to run PHP-FPM + Nginx
CMD ["supervisord", "-n"]
