FROM php:7-apache

RUN a2enmod rewrite

RUN apt-get update \
    && apt-get install -y zlib1g-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql zip

# add timezone settings
RUN echo "[Date]" > /usr/local/etc/php/php.ini
RUN echo "date.timezone = UTC" >> /usr/local/etc/php/php.ini
