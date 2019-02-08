#!/bin/bash
## CP File
cp ../env_files/.env ./.env

if [ -d "vendor" ]
then
    rm -rf vendor
fi
mkdir vendor
# Change owner to mode for next deploy
if [ $# -gt 0 ]
then
    echo "Start Change Mode & Owner"
    chmod -R 755 ./
    chown -R $1:$1 ./
fi

echo "Start Update Project"
composer install
php artisan migrate --force

echo "Start Clear Project"
php artisan view:clear


