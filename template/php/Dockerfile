FROM php:7-alpine

# Alternatively use ADD https:// (which will not be cached by Docker builder)
RUN echo "Pulling watchdog binary from Github." \
    && curl -sSL https://github.com/alexellis/faas/releases/download/0.7.3/fwatchdog > /usr/bin/fwatchdog \
    && chmod +x /usr/bin/fwatchdog

# create docker user
RUN addgroup -S docker && adduser -S -g docker docker

# create environment
RUN set -x \
    && mkdir /usr/local/faas

WORKDIR /usr/local/faas
COPY function   /usr/local/faas/function
COPY index.php php-extension.sh composer.*    ./
RUN chmod u+x ./php-extension.sh && ./php-extension.sh
RUN set -x \
    && chown -R docker /usr/local/faas

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
USER docker
RUN composer install --no-dev

# install function
WORKDIR /usr/local/faas/function

RUN [[ -f php-extension.sh ]] && sh ./php-extension.sh || \
    echo "php-extension.sh does not exist, skip installing PHP extensions"
RUN [[ -f composer.lock || -f composer.json ]] && composer install --no-dev || \
    echo "composer.lock does not exists, skip installing composer dependencies"

# done
USER root
WORKDIR /usr/local/faas
ENV fprocess "php index.php"
HEALTHCHECK --interval=1s CMD [ -e /tmp/.lock ] || exit 1
CMD ["fwatchdog"]