FROM php:7.2-fpm as base
MAINTAINER Maher LANDOLSI & ANOUAR KAHLA 

# Install PHP extensions and PECL modules.
RUN apt-get update && deps=" \
        apt-utils \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libcurl4-openssl-dev \
        libicu-dev \
        libmcrypt-dev \
        libssl-dev \
        wget \
        git \
        vim \
        netcat \
    " \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y -q $deps

RUN docker-php-ext-install intl zip \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -r /var/lib/apt/lists/*

RUN docker-php-ext-install mysqli pdo pdo_mysql


RUN pecl install xdebug-2.7.0 \
    && docker-php-ext-enable xdebug


RUN rm -rf var/cache/* var/logs/*

COPY ./ /
WORKDIR /var/www/
VOLUME /var/www

EXPOSE 9020 9020

#############################################################################################

From base

SHELL ["/bin/bash", "-c"]

RUN echo "you should now run composer install"

