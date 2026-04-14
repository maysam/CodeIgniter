FROM php:7.4-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli && \
    a2enmod rewrite && \
    printf '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/codeigniter.conf && \
    a2enconf codeigniter

COPY application /var/www/html/application
COPY system /var/www/html/system
COPY index.php /var/www/html/index.php

EXPOSE 80

CMD ["apache2-foreground"]
