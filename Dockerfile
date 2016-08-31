FROM yiizh/php7

MAINTAINER Di Zhang <zhangdi_me@163.com>

COPY . /app

RUN cd /app && \
    composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
    composer global require "fxp/composer-asset-plugin:~1.1.1" && \
    composer install -vvv --prefer-dist

RUN chmod -R /app/src/frontend/runtime \
    /app/src/console/web/assets \
    /app/src/frontend/runtime

RUN rm -rf /var/www/html && \
    ln -s /app/src/frontend/web /var/www/html

WORKDIR /app