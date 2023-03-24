FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Allow to install package
RUN apt update -y --allow-releaseinfo-change

# Install extensions
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mcrypt bcmath bz2 intl gd mbstring mysqli pdo pdo_mysql zip

# Setup apache virtual host
COPY etc /etc

RUN a2enmod rewrite && \
    a2dissite 000-default.conf && \
    a2ensite lamp.conf && \
    a2ensite lamp-dir.conf && \
    a2ensite lamp-ssl.conf && \
    service apache2 restart

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for apache
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /var/www/html

USER www

EXPOSE 80
EXPOSE 443
