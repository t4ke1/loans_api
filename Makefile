#CONTAINER START
build:
	docker compose up --build
#CHECK CONTAINER STATUS
status:
	docker compose ps
#open WORKDIR in php container
php_open:
	docker compose exec php bash
#install composer
composer:
	composer install
	composer update
#run migration
migrate:
	php artisan migrate
#run test
test:
	./vendor/bin/phpunit
#restart
docker_restart:
	docker compose down
	docker compose up -d

