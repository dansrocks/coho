ARG PHP_VERSION

FROM php:${PHP_VERSION}

ARG USER_ID
ARG GROUP_ID

RUN echo "Reassigning uid:gid for www-data to ${USER_ID}:${GROUP_ID}" \
    && apk --no-cache add shadow \
    && usermod -u ${GROUP_ID} www-data \
    && groupmod -g ${USER_ID} www-data

# Expose port 9000 and start php-fpm server
#EXPOSE 9000

CMD ["php-fpm"]