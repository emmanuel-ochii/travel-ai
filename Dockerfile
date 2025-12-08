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

# Copy application code
COPY . .

# Copy built assets
COPY --from=asset-builder /app/public/build ./public/build

# Install PCNTL for Horizon + Composer deps
RUN apk update && apk add --no-cache $PHPIZE_DEPS \
    && docker-php-ext-install pcntl \
    && composer install --optimize-autoloader --no-dev

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Start script
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80
CMD ["/start.sh"]
