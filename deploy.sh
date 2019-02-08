#!/bin/bash
## CP File
cp ../env_files/.env ./.env

if [ -d "vendor" ]
then
    rm -rf vendor
fi
mkdir vendor
chmod -R 755 storage
chmod -R 755 vendor

composer install
php artisan migrate --force
php artisan view:clear

# Change owner to mode for next deploy
if $# > 0
then
    chmod -R 755 ./
    chown -R $0:$0 ./
fi

