FROM php:7-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo_mysql
# add timezone settings
RUN echo "[Date]" > /usr/local/etc/php/php.ini
RUN echo "date.timezone = UTC" >> /usr/local/etc/php/php.ini
