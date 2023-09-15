install:
	composer install
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests --ignore=app/Models
start:
	php artisan serve
test:
	composer exec --verbose phpunit tests
