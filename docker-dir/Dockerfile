FROM php:7-apache

#COPY config/php.ini /usr/local/etc/php/

VOLUME /var/www/html

ARG xdebug=2.6.0

RUN pecl install xdebug-${xdebug} \
    && docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo pdo_mysql
