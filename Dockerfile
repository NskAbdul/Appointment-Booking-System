# Stage 1: Composer dependencies
FROM composer:2 as vendor

WORKDIR /app
COPY database/ database/
COPY composer.json composer.lock ./
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Stage 2: Frontend build with Vite
FROM node:20 as frontend

WORKDIR /app
COPY package.json package-lock.json vite.config.js ./
COPY resources/ resources/
RUN npm install && npm run build

# Stage 3: Production container with Apache and PHP
FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
      libpng-dev libjpeg-dev libfreetype6-dev zip unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql bcmath

# Apache config
RUN a2enmod rewrite
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Application files
WORKDIR /var/www/html
COPY --from=vendor /app/vendor/ vendor/
COPY --from=frontend /app/public/build/ public/build/
COPY . .

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache



EXPOSE 80
