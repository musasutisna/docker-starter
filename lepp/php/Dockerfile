FROM php:7.4-fpm

# Set working directory
WORKDIR /usr/share/nginx/html

# Allow to install package
RUN apt update -y

# Install extensions
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mcrypt bcmath bz2 intl gd mbstring pgsql pdo pdo_pgsql zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
