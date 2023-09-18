ARG PHP_VERSION

FROM php:${PHP_VERSION}-apache

ENV LD_LIBRARY_PATH="/opt/oracle/instantclient"
ENV ORACLE_HOME="/opt/oracle/instantclient"

# Set proper file permissions
RUN chown -R www-data:www-data /var/www/html

RUN usermod -u 1000 www-data
RUN cd /tmp

# Install dependencies
RUN apt-get update
RUN apt-get install --yes --force-yes cron g++ gettext libicu-dev openssl libc-client-dev libkrb5-dev  libxml2-dev libfreetype6-dev libgd-dev libmcrypt-dev bzip2 libbz2-dev libtidy-dev libcurl4-openssl-dev libz-dev libmemcached-dev libxslt-dev

# PHP Configuration
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install bz2
RUN docker-php-ext-install calendar
RUN docker-php-ext-install dba
RUN docker-php-ext-install exif
RUN docker-php-ext-install fileinfo
RUN docker-php-ext-install gettext
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl
RUN docker-php-ext-install imap
RUN docker-php-ext-install intl
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install soap
RUN docker-php-ext-install tidy
RUN docker-php-ext-install xmlrpc
RUN docker-php-ext-install xsl
RUN docker-php-ext-configure hash --with-mhash
RUN docker-php-ext-install sockets

# Apache configs + document root.
RUN echo "ServerName laravel-app.local" >> /etc/apache2/apache2.conf

# mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
RUN a2enmod rewrite headers

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Composer
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer
