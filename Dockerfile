FROM php:8.3.0-zts-alpine3.17

RUN apk update
RUN apk add --no-cache openssl bash

RUN apk add --no-cache --update linux-headers
RUN docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

RUN apk add --no-cache $PHPIZE_DEPS \
&& pecl install xdebug-3.1.6 \
&& docker-php-ext-enable xdebug

ADD . /home/www/vehicles
RUN chown -R www-data:www-data /home/www/vehicles

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
WORKDIR /home/www/vehicles
#RUN php artisan serve

USER $user
#CMD php artisan serve --host=0.0.0.0 --port=8181
#EXPOSE 8181
# CMD ["sh", "-c", "php artisan serve"]
