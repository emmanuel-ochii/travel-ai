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

# Copy Laravel app
COPY . .

# Copy built Vite assets
COPY --from=asset-builder /app/public/build ./public/build

# Install PHP extensions + Composer packages
RUN apk update && apk add --no-cache \
        autoconf dpkg-dev dpkg file g++ gcc libc-dev make pkgconf re2c \
    && docker-php-ext-install pcntl \
    && composer install --optimize-autoloader --no-dev

# Build Filament assets
RUN php artisan filament:assets

# Create symlink for public storage (ignore if already exists)
RUN php artisan storage:link || true

# Optimize for production
RUN php artisan optimize

# Fix permissions safely
RUN for dir in storage bootstrap/cache public/build; do \
    [ -d "$dir" ] && chown -R www-data:www-data "$dir"; \
done

COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
