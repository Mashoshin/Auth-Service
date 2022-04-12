FROM php:8.1.0-cli

WORKDIR /var/www

COPY . .

COPY ./.dockerfiles/dev/fpm/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update && apt-get install -y \
    supervisor \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && mkdir -p /var/log/supervisor