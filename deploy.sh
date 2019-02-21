#!/bin/bash
cp ../../env_files/.env ./.env

yarn install
npm run dev

if [ -d "vendor" ]
then
    rm -rf vendor
fi
mkdir vendor

# Change owner to mode for next deploy
if [ $# -gt 0 ]
then
    echo "Start Change Mode & Owner"
    chmod -R 775 ./vendor/
    chmod -R 775 ./storage/
    chown -R $1:$1 ./
    chcon -R -t httpd_sys_rw_content_t storage
fi

composer install
php artisan migrate --force

# Clear
php artisan view:clear
