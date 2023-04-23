FROM php:8.1-fpm

RUN apt-get update && \
    apt-get install -y libpq-dev curl && \
    docker-php-ext-install pdo pdo_pgsql pgsql sockets && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug

WORKDIR /var/www/code

ENTRYPOINT ["/usr/local/bin/php", "/var/www/code/artisan", "queue:listen", "--tries=1"]
