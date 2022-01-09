

FROM php:fpm-alpine

RUN docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /var/www/html/

EXPOSE 3030/tcp

# RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

# RUN composer install

ENTRYPOINT [ "/var/www/html/migration.sh" ]
# CMD [ "php", "-S", "0.0.0.0:8000", "-t", "public" ] 