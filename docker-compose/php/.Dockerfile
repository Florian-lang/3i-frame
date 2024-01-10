FROM php:8.3-fpm

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y --fix-missing \
    apt-utils \
    gnupg

RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -

RUN apt-get update && apt-get install -y --fix-missing \
    git \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev \
    libpng-dev \
    libgmp3-dev \
    libpq-dev \
    postgresql \
    postgresql-contrib \
    vim \
    nodejs \
    libcurl4-openssl-dev \
    libonig-dev \
    libxslt-dev

RUN docker-php-ext-install opcache && docker-php-ext-enable opcache

RUN docker-php-ext-install soap
RUN docker-php-ext-install calendar
RUN docker-php-ext-install zip
RUN docker-php-ext-install gmp
RUN docker-php-ext-install gd
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install curl
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install intl
RUN docker-php-ext-install xsl

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN printf '[PHP]\ndate.timezone = "Europe/Paris"\n' > /usr/local/etc/php/conf.d/tzone.ini

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
