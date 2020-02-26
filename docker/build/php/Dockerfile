FROM php:7.3-apache

RUN apt-get update \
  && apt-get install -y git zlib1g-dev libzip-dev unzip \
  && rm -rf /var/lib/apt/lists/* \
  && docker-php-ext-install pdo pdo_mysql zip mysqli \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
  && a2enmod rewrite headers

COPY . /var/www/html/
