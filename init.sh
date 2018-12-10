#!/bin/sh
# if vendor not exist

chmod -R 777 storage

if [ ! -d "vendor" ] 
then
    mkdir vendor
    chmod -R 777 vendor
    composer install
    php artisan make:database hanagacha
fi

composer update
php artisan migrate

# start php-fpm
/usr/local/sbin/php-fpm