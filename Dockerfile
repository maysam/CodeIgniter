FROM php:7.4-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli && \
    a2enmod rewrite && \
    printf '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/codeigniter.conf && \
    a2enconf codeigniter

COPY . /var/www/html/

EXPOSE 80

CMD ["apache2-foreground"]
