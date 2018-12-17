PWD = $(shell pwd)
SHELL=/bin/bash

init: 
	${SHELL} ./init.sh

clean-vendor:
	rm -rf vendor

clean-env:
	rm -f .env

clean-all:
	clean-vendor clean-env

local-docker-up:
	docker-compose up --build -d --remove-orphans

local-docker-status:
	docker-compose ps

local-docker-down:
	docker-compose down

# ex:make CONTROLLER_NAME=Test create/controller
# ex:make CONTROLLER_NAME=Api/Test create/controller
create/controller:
	docker exec -d hanagacha_php_1 bash -c "php artisan make:controller $(CONTROLLER_NAME)Controller"

make/dir/view:
	mkdir ./resources/views/$(VIEW_DIR_NAME)

# ex:make VIEW_NAME=test create/view
# ex:make VIEW_NAME=admin/test create/view
create/view:
	touch ./resources/views/$(VIEW_NAME).blade.php

create/model:
	docker exec -d hanagacha_php_1 bash -c "php artisan make:model $(MODEL_NAME) -m"

migrate:
	docker exec -d hanagacha_php_1 bash -c "php artisan migrate"

migrate/create:
	docker exec -d hanagacha_php_1 bash -c "php artisan php artisan make:migration php artisan make:migration create_$(TABLE_NAME)_table --create=$(TABLE_NAME)"

migrate/add-cols:
	docker exec -d hanagacha_php_1 bash -c "php artisan php artisan make:migration php artisan make:migration add_cols_$(TABLE_NAME)_table --table=$(TABLE_NAME)"