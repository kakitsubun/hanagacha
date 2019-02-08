#!/bin/bash
## CP File
cp ../env_files/.env ./

if [ -d "vendor" ]
then
    rm -rf vendor
fi
mkdir vendor
chmod -R 777 vendor
chmod -R 777 storage

composer install
php artisan migrate
php artisan view:clear

## cp
#npm dev

