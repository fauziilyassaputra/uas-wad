FROM php:8.3-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
        git unzip libzip-dev \
    && docker-php-ext-install pdo_mysql bcmath zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite \
    && sed -ri 's!DocumentRoot /var/www/html!DocumentRoot /var/www/html/public!' /etc/apache2/sites-available/000-default.conf \
    && printf '%s\n' \
        'ServerName localhost' \
        '<Directory /var/www/html/public>' \
        '    AllowOverride All' \
        '    Require all granted' \
        '</Directory>' \
        > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize --no-dev \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache

RUN printf '%s\n' \
        '#!/bin/sh' \
        'set -e' \
        'PORT="${PORT:-80}"' \
        'sed -ri "s/^Listen [0-9]+$/Listen ${PORT}/" /etc/apache2/ports.conf' \
        'sed -ri "s/<VirtualHost \*:[0-9]+>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf' \
        'if [ "$RUN_MIGRATIONS" = "true" ]; then php artisan migrate --force || echo "Migrasi gagal, aplikasi tetap dijalankan"; fi' \
        'exec apache2-foreground' \
        > /usr/local/bin/start.sh \
    && chmod +x /usr/local/bin/start.sh

EXPOSE 10000

CMD ["start.sh"]