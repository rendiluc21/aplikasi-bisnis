FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libzip-dev libonig-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip bcmath
    
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN a2dismod mpm_event mpm_worker mpm_prefork 2>/dev/null; a2enmod mpm_prefork rewrite

RUN sed -ri -e 's!Listen 80!Listen ${PORT}!g' /etc/apache2/ports.conf
RUN sed -ri -e 's!<VirtualHost \*:80>!<VirtualHost *:${PORT}>!g' /etc/apache2/sites-available/*.conf

EXPOSE ${PORT}
