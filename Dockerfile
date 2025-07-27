# Stage 1: Install PHP dependencies with Composer
FROM composer:2 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist


# Stage 2: Build frontend assets with Node.js
FROM node:20 as frontend

WORKDIR /app
COPY package.json package.json
COPY package-lock.json package-lock.json
COPY vite.config.js vite.config.js
COPY resources/ resources/
RUN npm install
RUN npm run build


# Stage 3: Create the final production image with Apache
FROM php:8.2-apache

# Set up necessary PHP extensions
RUN apt-get update && apt-get install -y \
      libpng-dev \
      libjpeg-dev \
      libfreetype6-dev \
      zip \
      unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql bcmath

# Configure Apache
RUN a2enmod rewrite
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copy application files and built assets
WORKDIR /var/www/html
COPY --from=vendor /app/vendor/ vendor/
COPY --from=frontend /app/public/build/ public/build/
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080