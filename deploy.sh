#!/bin/bash
## CP File
cp ../env_files/*.* ./

rm -rf vendor

composer install
php artisan migrate
php artisan view:clear

## cp
#npm dev

