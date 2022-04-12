FROM php:8.1.0-fpm

WORKDIR /var/www

COPY . .

COPY ./.dockerfiles/dev/fpm/custom-php.ini /usr/local/etc/php/conf.d/custom-php.ini
COPY ./.dockerfiles/dev/fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev \
        supervisor \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) intl \
    && docker-php-ext-install -j$(nproc) pgsql \
    && docker-php-ext-install -j$(nproc) pdo_pgsql \
    && mkdir -p /var/log/supervisor

RUN pecl install -o -f redis \
&&  docker-php-ext-enable redis