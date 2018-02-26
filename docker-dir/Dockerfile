FROM php:7-apache

#COPY config/php.ini /usr/local/etc/php/

VOLUME /var/www/html

ARG redis=2.5.0

RUN pecl install xdebug-${redis} \
    && docker-php-ext-enable xdebug
