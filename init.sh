#!/bin/sh 
chmod -R 777 storage 

if [ ! -f ".env" ]
then 
    if [ -d "vendor" ] 
    then 
        rm -rf vendor 
    fi 
    mkdir vendor 
    chmod -R 777 vendor 
    composer install 
    cp -f env.local .env 
    php artisan key:generate 
fi 

composer update 
php artisan migrate
# start php-fpm 
/usr/local/sbin/php-fpm 