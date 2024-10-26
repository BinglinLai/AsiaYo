FROM php:7.4-fpm-alpine


RUN apk -U upgrade

RUN apk add \
        bash \
        git \
        vim \
        autoconf \
        gcc \
        g++ \
        make

RUN apk add --no-cache \
        freetype \
        freetype-dev \
        libjpeg-turbo \
        libjpeg-turbo-dev \
        # imap-dev krb5-dev
        imagemagick imagemagick-dev

# Use the default development configuration
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-configure bcmath

RUN docker-php-ext-configure pcntl 
        # docker-php-ext-install pcntl

# RUN docker-php-ext-configure imap 

RUN docker-php-ext-configure sockets

RUN docker-php-ext-configure \
        gd \
        --with-freetype \
        --with-jpeg 

RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install \
        # imap \
        pdo_mysql \
        sockets \
        pcntl
        # opcache


# RUN php-config --extension-dir && exit 1
ENV PHP_EXT_DIR /usr/local/lib/php/extensions/no-debug-non-zts-20190902

RUN wget https://github.com/FriendsOfPHP/pickle/releases/latest/download/pickle.phar -P "$PHP_EXT_DIR/" \
        && php "$PHP_EXT_DIR/pickle.phar" \
        && chmod +x "$PHP_EXT_DIR/pickle.phar" \
        && "$PHP_EXT_DIR/pickle.phar" info apcu \
        && mv "$PHP_EXT_DIR/pickle.phar" /usr/local/bin/pickle

RUN pickle install redis --defaults \
        && docker-php-ext-enable redis

RUN pickle install imagick --defaults \
        && docker-php-ext-enable imagick

RUN docker-php-ext-enable pcntl


## composer
RUN type composer 2>/dev/null || \
    curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer


# 
# COPY bin/* /usr/local/bin/
# COPY src/* /usr/local/src/


# supervisor
# RUN apk add --no-cache supervisor \
#         && mkdir -p /var/log/supervisor

# COPY supervisor/* /etc/supervisor/

# ENV SUPERVISOR_LOG_DIR /var/log/supervisor


# nodejs npm
# RUN apk add --update nodejs npm