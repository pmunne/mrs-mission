FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY backend /var/www
WORKDIR /var/www

RUN composer install --no-interaction --prefer-dist --optimize-autoloader