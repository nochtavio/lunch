FROM php:7.3-fpm-alpine

RUN apk update
RUN apk add bash
RUN apk add curl

WORKDIR /var/www

COPY ./ /var/www

COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD composer install ; php-fpm