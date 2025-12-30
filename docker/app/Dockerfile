ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-fpm

RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev; \
    if php -r 'exit(version_compare(PHP_VERSION,"7.4","<") ? 0 : 1);'; then \
    docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/; \
    else \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    fi; \
    docker-php-ext-install -j"$(nproc)" \
    gd \
    mysqli \
    zip \
    exif \
    opcache; \
    rm -rf /var/lib/apt/lists/*

COPY php.ini /usr/local/etc/php/conf.d/zz-local.ini
COPY zz-www.conf /usr/local/etc/php-fpm.d/zz-www.conf

WORKDIR /var/www/html
