install:
	composer install
lint:
	composer exec --verbose phpcs -- --standard=PSR12 src
start:
	php artisan serve