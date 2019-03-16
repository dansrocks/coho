ARG PHP_VERSION

FROM php:${PHP_VERSION}

ARG USER_ID
ARG GROUP_ID

RUN echo "Reassigning uid:gid for www-data to ${USER_ID}:${GROUP_ID}" \
    && apk --no-cache update \
    && apk --no-cache upgrade \
    && apk --no-cache add shadow \
    && usermod -u ${GROUP_ID} www-data \
    && groupmod -g ${USER_ID} www-data \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable pdo_mysql

# Expose port 9000 and start php-fpm server
#EXPOSE 9000

CMD ["php-fpm"]