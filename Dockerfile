FROM php:7.4-apache

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y --no-install-recommends default-mysql-client && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install mysqli

COPY . /var/www/html
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint

RUN chmod +x /usr/local/bin/app-entrypoint

RUN a2enmod rewrite && \
    printf '<Directory /var/www/html>\nAllowOverride All\nRequire all granted\n</Directory>\n' > /etc/apache2/conf-available/codeigniter.conf && \
    a2enconf codeigniter

ENTRYPOINT ["app-entrypoint"]

EXPOSE 80
