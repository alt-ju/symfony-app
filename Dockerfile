# Utilise une image PHP avec FPM et les extensions nécessaires
FROM php:8.1-fpm

# Installer dépendances système et PHP (ajuste selon besoins)
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copier configuration nginx custom (assure-toi d'avoir ce fichier)
COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Copier le code source dans le conteneur
WORKDIR /var/www/html
COPY . .

# Installer Composer et dépendances PHP
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Donner les droits nécessaires (selon Symfony)
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor

# Copier le script de démarrage
COPY ./docker/start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
