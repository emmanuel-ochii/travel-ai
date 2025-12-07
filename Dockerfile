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

# Copy .env.example so Laravel can generate key if needed
RUN cp .env.example .env || true

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate app key (only if missing)
RUN php artisan key:generate --force || true

# Make start script executable
RUN chmod +x start.sh

# Expose port for Render
EXPOSE 8080

# 🔥 Use custom startup script
CMD ["./start.sh"]
