ARG PHP_BASE=fpm
ARG PHP_VERSION=8.2
ARG ALPINE_VERSION=3.17

FROM php:${PHP_VERSION}-${PHP_BASE}-alpine${ALPINE_VERSION} AS symfony_php_base

# persistent / runtime deps
RUN apk add --no-cache \
		acl \
		fcgi \
		file \
		gettext \
		git \
		gnu-libiconv \
        so:libpq.so.5 \
	;

# install gnu-libiconv and set LD_PRELOAD env to make iconv work fully on Alpine image.
# see https://github.com/docker-library/php/issues/240#issuecomment-763112749
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so

ARG APCU_VERSION=5.1.21
RUN set -eux; \
	apk add --no-cache --virtual .build-deps \
		$PHPIZE_DEPS \
		icu-dev \
        postgresql-dev \
		libzip-dev \
        curl-dev \
		zlib-dev \
	; \
	\
	docker-php-ext-configure zip; \
	docker-php-ext-install -j$(nproc) \
		intl \
		curl \
        pdo_pgsql \
		zip \
	; \
	pecl install \
		apcu-${APCU_VERSION} \
	; \
	pecl clear-cache; \
	docker-php-ext-enable \
		apcu \
		opcache \
	; \
	\
	runDeps="$( \
		scanelf --needed --nobanner --format '%n#p' --recursive /usr/local/lib/php/extensions \
			| tr ',' '\n' \
			| sort -u \
			| awk 'system("[ -e /usr/local/lib/" $1 " ]") == 0 { next } { print "so:" $1 }' \
	)"; \
	apk add --no-cache --virtual .phpexts-rundeps $runDeps; \
	\
	apk del .build-deps

COPY php-fpm.d/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

FROM symfony_php_base AS symfony_php

COPY conf.d/prod.ini $PHP_INI_DIR/conf.d/prod.ini

VOLUME /var/run/php

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ARG COMPOSER_AUTH

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /var/www/app

###> recipes ###
###< recipes ###

COPY . .

RUN set -eux; \
	mkdir -p var/cache var/log; \
	composer install --prefer-dist --no-dev --no-progress --no-scripts --no-interaction; \
	composer dump-autoload --classmap-authoritative --no-dev; \
	composer symfony:dump-env prod; \
	composer run-script --no-dev post-install-cmd; \
	chmod +x bin/console; sync
VOLUME /var/www/app/var

#ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

FROM symfony_php_base AS symfony_php_dev

COPY conf.d/dev.ini $PHP_INI_DIR/conf.d/dev.ini
#COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
#RUN chmod +x /usr/local/bin/docker-entrypoint

# Install PCOV
RUN apk add --no-cache autoconf build-base
RUN pecl install pcov && docker-php-ext-enable pcov

VOLUME /var/run/php

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ARG COMPOSER_AUTH

ENV PATH="${PATH}:/root/.composer/vendor/bin"

WORKDIR /var/www/app

RUN set -eux; mkdir -p var/cache var/log public; sync
VOLUME /var/www/app/var

#ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]
