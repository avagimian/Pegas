FROM php:8.1.9-fpm-alpine3.16

# Основные зависимости
RUN docker-php-ext-configure opcache --enable-opcache && \
    apk update && apk add bash unzip git

RUN apk add --no-cache libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

CMD php-fpm;
