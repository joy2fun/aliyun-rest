FROM ghcr.io/joy2fun/docker-php-alpine:master

COPY --chown=www-data:www-data . .

ENV PHP_OPCACHE_ENABLE=1

RUN composer install -n --no-dev --no-progress --optimize-autoloader \
    && composer clear-cache \
    && mv .env.example .env \
    && mkdir -p /var/www/.config/psysh \
    && touch storage/logs/laravel.log

VOLUME [ "/var/www/html/storage/logs" ]
