FROM php:8.0.2-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd


COPY /apache/sites-available /etc/apache2/sites-available

RUN { \
        echo 'SetEnv SITE_NAME ${SITE_NAME}'; \
        echo 'SetEnv SITE_TYPE ${SITE_TYPE}'; \
    } > /etc/apache2/conf-enabled/environment.conf

RUN a2enmod rewrite; a2ensite ${SITE_NAME}
