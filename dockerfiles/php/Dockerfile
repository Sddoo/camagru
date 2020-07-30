FROM php:7.4-fpm

RUN apt-get update -y && apt-get install -y \ 
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get install -y -q --no-install-recommends msmtp \
    && apt install nano \
    && rm -rf /var/lib/apt/lists/* 
