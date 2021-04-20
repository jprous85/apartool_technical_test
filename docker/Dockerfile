FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
        gcc make autoconf libfreetype6-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev libxml++2.6-dev libicu-dev g++ libmcrypt-dev; \

        pecl config-set php_ini "${PHP_INI_DIR}/php.ini";\
        pecl install mcrypt-1.0.3 && docker-php-ext-enable mcrypt \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) intl pdo_mysql bcmath mbstring exif gd

RUN apt-get install -y curl
RUN apt-get install -y git
RUN apt-get install -y unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

RUN apt -y install curl dirmngr apt-transport-https lsb-release ca-certificates
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -

RUN apt -y install nodejs

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt install -y yarn

COPY ./virtualhost.conf /etc/apache2/sites-available/

RUN a2dissite 000-default.conf; \
    a2enmod headers; \
    a2enmod rewrite; \
    a2ensite virtualhost.conf; \
    service apache2 restart;
