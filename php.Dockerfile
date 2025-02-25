FROM php:8.3.11-fpm-alpine

RUN mkdir -p /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

EXPOSE 9000 

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]