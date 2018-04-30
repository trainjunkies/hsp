FROM php:5.6.34-alpine

ARG XDEBUG_REMOTE_ENABLE
ENV XDEBUG_REMOTE_ENABLE ${XDEBUG_REMOTE_ENABLE:-'on'}

ARG XDEBUG_REMOTE_HOST
ENV XDEBUG_REMOTE_HOST ${XDEBUG_REMOTE_HOST:-'10.254.254.25'}

ARG XDEBUG_REMOTE_PORT
ENV XDEBUG_REMOTE_PORT ${XDEBUG_REMOTE_PORT:-'9000'}

ARG XDEBUG_REMOTE_AUTOSTART
ENV XDEBUG_REMOTE_AUTOSTART ${XDEBUG_REMOTE_AUTOSTART:-'off'}

RUN apk add --no-cache $PHPIZE_DEPS curl libxml2-dev \
    && pecl install xdebug-2.5.5 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install xml soap \
    && echo xdebug.remote_enable=${XDEBUG_REMOTE_ENABLE} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_autostart=${XDEBUG_REMOTE_AUTOSTART} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_host=${XDEBUG_REMOTE_HOST} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_port=${XDEBUG_REMOTE_PORT} >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_handler=dbgp >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo xdebug.remote_connect_back=0 >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && curl -sS  https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin \
    && rm -rf /tmp/*
