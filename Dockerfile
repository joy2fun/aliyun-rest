FROM ghcr.io/joy2fun/docker-php:master

# COPY docker/php.ini /usr/local/etc/php/conf.d/zzz.ini
COPY docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
COPY --chown=www-data:www-data . .

RUN mv .env.example .env
