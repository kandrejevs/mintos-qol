FROM php:7.3-fpm

LABEL maintainer="mail@kandrejevs.com"

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        wget \
        libldb-dev \
        python \
        vim \
        unzip \
        mysql-client \
        zip \
        libpq-dev \
        libgd2-dev \
        libjpeg-dev \
        libgif-dev \
        libwebp-dev \
        apt-utils \
        nodejs \
        && docker-php-ext-install -j$(nproc) pdo_mysql mysqli pgsql pdo_pgsql \
        && docker-php-ext-install -j$(nproc) sockets pcntl \
        && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-webp-dir=/usr/include/ \
        && docker-php-ext-install -j$(nproc) gd \
        # Install Redis and xDebug
        && pecl install redis \
        && docker-php-ext-enable redis \
        ## Install Composer
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
        && composer --version \
        && composer global require hirak/prestissimo \
        && npm install -g sqip

RUN node --version \
    && npm --version

## Apply correct permissions and switch user
RUN usermod -u 1000 www-data
USER www-data

EXPOSE 9000
CMD ["php-fpm"]