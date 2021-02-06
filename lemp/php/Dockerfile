FROM php:7.4-fpm

# Set working directory
WORKDIR /usr/share/nginx/html

# Allow to install package
RUN apt update -y

# Install extensions
ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/

RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mcrypt bcmath bz2 intl gd mbstring mysqli pdo pdo_mysql zip

# Install composer
RUN if ["$COMPOSER" = "yes"]; then\
      php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
      php -r "if (hash_file('sha384', 'composer-setup.php') === '8a6138e2a05a8c28539c9f0fb361159823655d7ad2deecb371b04a83966c61223adc522b0189079e3e9e277cd72b8897') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
      php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
      php -r "unlink('composer-setup.php');";\
    fi

# Add user for nginx
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /usr/share/nginx/html

USER www

EXPOSE 9000

CMD ["php-fpm"]
