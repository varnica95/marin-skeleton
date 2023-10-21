ARG PHP_VERSION=8.2
FROM php:${PHP_VERSION}-fpm-alpine

ARG DOCKER_UID
ARG DOCKER_GID

ENV DOCKER_UID=${DOCKER_UID}
ENV DOCKER_GID=${DOCKER_GID}

WORKDIR /app

RUN addgroup -g ${DOCKER_GID} --system user
RUN adduser -G user --system -D -s /bin/sh -u ${DOCKER_UID} user

RUN sed -i "s/user = www-data/user = user/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = user/g" /usr/local/etc/php-fpm.d/www.conf
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install OS dependencies
RUN apk update
RUN apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS
RUN apk add --update --no-cache autoconf bash figlet pkgconf libssl1.1 openssl-dev freetype-dev libpng-dev libjpeg-turbo-dev libmcrypt-dev git openssh-client curl wget libtool zlib-dev icu-dev g++ linux-headers libzip-dev mysql-client

# Install general PHP modules
RUN docker-php-ext-install mysqli \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j2 intl \
    && pecl bundle -d /usr/src/php/ext apcu \
    && docker-php-ext-install -j2 apcu \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j2 bcmath \
    && docker-php-ext-install -j2 gd \
    && docker-php-ext-install -j2 zip \
    && docker-php-ext-enable opcache

# Install redis
RUN pecl bundle -d /usr/src/php/ext redis \
    && docker-php-ext-install -j2 redis

# Install X-debug
RUN pecl install xdebug

# Cleanup
RUN rm /usr/src/php/ext/*.tgz

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod u+s /usr/bin/composer

RUN echo 'linux' > /etc/docker_host && \
    chmod +r /etc/docker_host

# I can't help myself
RUN apk add vim nano

RUN chown -R user:user /app

USER user

CMD ["php-fpm", "-y", "/usr/local/etc/php-fpm.conf", "-R"]
