FROM yiizh/php7

MAINTAINER Di Zhang <zhangdi_me@163.com>

COPY . /app

RUN cd /app && \
    composer config -g repo.packagist composer https://packagist.phpcomposer.com && \
    composer global require "fxp/composer-asset-plugin:~1.1.1" && \
    composer install -vvv --prefer-dist

RUN chmod -R 777 /app/src/frontend/runtime \
    /app/src/frontend/web/assets \
    /app/src/frontend/web/uploads \
    /app/src/console/runtime

RUN sed -i "s/'YII_DEBUG', true/'YII_DEBUG', false/g" /app/src/frontend/web/index.php && \
    sed -i "s/'YII_ENV', 'dev'/'YII_ENV', 'prod'/g" /app/src/frontend/web/index.php

RUN sed -i "s/\/var\/www\/html/\/app\/src\/frontend\/web/g"  /etc/apache2/sites-available/000-default.conf

WORKDIR /app