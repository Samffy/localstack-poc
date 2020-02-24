
ARG PHP_VERSION

FROM php:${PHP_VERSION}-fpm-alpine

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN apk upgrade --no-cache --quiet --available

RUN apk add \
    php7-fpm \
    php7-apcu \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-iconv \
    php7-json \
    php7-intl \
    php7-fileinfo\
    php7-mbstring \
    php7-openssl \
    php7-xml \
    php7-zlib \
    php7-simplexml \
    php7-xdebug \
    php7-zip \
    curl \
    bash

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/* && \
    curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

WORKDIR /var/www

COPY .env /var/www
COPY composer.json /var/www
COPY composer.lock /var/www

COPY docker/php-fpm/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint
ENTRYPOINT ["docker-entrypoint"]

CMD ["php-fpm7", "-F"]