FROM alpine:latest

# Arguments defined in docker-compose.yml
ARG user
ARG uid

WORKDIR /var/www
COPY . /var/www
RUN cp .env.prod .env

# Install packages and remove default server definition
RUN apk add --no-cache \
  bash \
  curl \
  git \
  libpng-dev \
  libxml2-dev \
  nginx \
  npm \
  supervisor \
  unzip \
  zip \
  php81 \
  php81-bcmath \
  php81-ctype \
  php81-curl \
  php81-dom \
  php81-exif \
  php81-fileinfo \
  php81-fpm \
  php81-gd \
  php81-intl \
  php81-mbstring \
  php81-mysqli \
  php81-opcache \
  php81-openssl \
  php81-pcntl \
  php81-pdo \
  php81-pdo_mysql \
  php81-pdo_sqlite \
  php81-phar \
  php81-session \
  php81-simplexml \
  php81-tokenizer \
  php81-xml \
  php81-xmlreader \
  php81-xmlwriter \
  php81-zlib

# Create symlink so programs depending on `php` still function
RUN ln -s /usr/bin/php81 /usr/bin/php

# Configure nginx
COPY docker-compose/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY docker-compose/fpm-pool.conf /etc/php81/php-fpm.d/www.conf
COPY docker-compose/php.ini /etc/php81/conf.d/custom.ini

# Configure supervisord
COPY docker-compose/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Get latest NPM
RUN npm install -g npm

# Create system user to run Composer and Artisan Commands
RUN adduser -u $uid -D $user
RUN addgroup $user www-data && \
    addgroup $user root
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Make sure files/folders needed by the processes are accessable when they run under the non-root user
RUN chown -R $user.$user /var/www /run /var/lib/nginx /var/log/nginx

# Switch to use a non-root user from here on
USER $user

# Install composer dependencies
RUN composer install && composer dumpautoload

# Expose the port nginx is reachable on
EXPOSE 8080

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
