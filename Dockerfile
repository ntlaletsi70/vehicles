FROM php:8.0-fpm-alpine3.16

RUN apk update
RUN apk add --no-cache openssl bash

RUN apk add --no-cache $PHPIZE_DEPS \
&& pecl install xdebug-3.1.6 \
&& docker-php-ext-enable xdebug

ADD . /var/www
RUN chown -R www-data:www-data /var/www

  # Add a non-root user to prevent files being created with root permissions on host machine.
ENV USER=laravel
ENV UID 1000
ENV GID 1000

RUN addgroup --gid "$GID" "$USER" \
    && adduser \
    --disabled-password \
    --gecos "" \
    --home "$(pwd)" \
    --ingroup "$USER" \
    --no-create-home \
    --uid "$UID" \
    "$USER"

WORKDIR /var/www

ENTRYPOINT ["php-fpm"]
WORKDIR /var/www

USER $user