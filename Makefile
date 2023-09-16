install:
	composer install
lint:
	composer exec --verbose phpcs -- --standard=PSR12 app routes tests --ignore=app/Models
start:
	php artisan serve
front:
	npm run dev
test:
	php artisan test
