# ---------- Stage 1: Build Vite Assets ----------
FROM node:18 AS asset-builder
WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# ---------- Stage 2: Runtime with Nginx + PHP ----------
FROM richarvey/nginx-php-fpm:latest
WORKDIR /var/www/html

# Copy Laravel application
COPY . .

# Copy Vite build output
COPY --from=asset-builder /app/public/build ./public/build

# Install PHP extensions + composer dependencies
RUN apk update && apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pcntl \
    && composer install --optimize-autoloader --no-dev

# Publish Filament assets
RUN php artisan filament:assets --force

# Cache configs, routes, and views
RUN php artisan optimize

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache public/vendor

# Add startup script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
