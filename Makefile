docker-build:
	docker-compose build

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-laravel-migrate:
	docker exec laravel_app bash -c "php artisan migrate"

docker-laravel-route-clear:
	docker exec laravel_app bash -c "php artisan route:clear"

docker-laravel-serve:
	docker exec laravel_app bash -c "php artisan serve --host=0.0.0.0 --port=9000"
