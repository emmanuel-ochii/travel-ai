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

# Copy Laravel code
COPY . .

# Copy built Vite assets
COPY --from=asset-builder /app/public/build ./public/build

# Install composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
CMD ["/start.sh"]
