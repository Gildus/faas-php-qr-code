#!/bin/sh

docker-php-source extract && \
apk add --update --no-cache \
            libpng \
            libpng-dev && \
 docker-php-ext-install gd