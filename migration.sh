#!/bin/sh

php artisan migrate

php artisan cache:clear 
php -S 0.0.0.0:3030 -t public
# php artisan swoole:http start
