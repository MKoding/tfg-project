FROM php:8.3-fpm-alpine

ENV PORT=80

RUN apk add --no-cache nginx wget bash sqlite-dev

RUN docker-php-ext-install pdo_mysql pdo_sqlite

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app
COPY .env.prod .env

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN cd /app && \
    /usr/local/bin/composer install --no-dev

RUN chown -R www-data: /app

CMD sh /app/docker/startup.sh
