ARG ARCH=amd64
FROM php:8.2-fpm

# Update package lists and install necessary dependencies
RUN apt-get update \
    && apt-get install -y libpq-dev nano \
    && apt-get install -y \
        git \
        curl \
        zlib1g-dev \
        libzip-dev \
        unzip \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && pecl install apcu \
    && docker-php-ext-enable apcu
ENV COMPOSER_ALLOW_SUPERUSER 1
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY . /mfo
WORKDIR /mfo


CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
