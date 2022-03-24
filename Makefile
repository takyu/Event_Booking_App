CMD=bash

buildup:
	@make build
	@make up

build:
	docker compose build

up:
	docker compose up -d

ps:
	docker compose ps

app:
	docker compose exec app $(CMD)

app-i-composer:
	@make i-composer-for-container
	@make i-composer-for-host

app-i-composer-for-container:
	docker compose exec app composer install

app-i-composer-for-host:
	docker compose run --rm -v $$(pwd)/src:/code -w /code app composer install

app-i-npm:
	@make i-npm-for-container
	@make i-npm-for-host

app-i-npm-for-container:
	docker compose exec app npm install

app-i-npm-for-host:
	docker compose run --rm -v $$(pwd)/src:/code -w /code app npm install

app-i-laravel-debugger:
	docker compose exec app composer require barryvdh/laravel-debugbar
	@make i-composer-for-host

app-i-jetstream:
	docker compose exec app composer require laravel/jetstream
	@make i-composer-for-host
	docker compose exec app php artisan jetstream:install livewire
	@make i-npm
	@make app-npm-dev
	@make app-migrate

app-npm-dev:
	docker compose exec app npm run dev

app-npm-watch:
	docker compose exec app npm run watch

app-migrate:
	docker compose exec app php artisan migrate

app-migrate-fresh:
	docker compose exec app php artisan migrate:fresh

app-migrate-fresh-seed:
	docker compose exec app php artisan migrate:fresh --seed

app-link-storage:
	docker compose exec app php artisan storage:link

app-route-list:
	docker compose exec app php artisan route:list

app-publish-jetstream-route:
	docker compose exec app php artisan vendor:publish --tag=jetstream-routes

app-publish-jetstream-view:
	docker compose exec app php artisan vendor:publish --tag=jetstream-views

app-custom-error-page:
	docker compose exec app php artisan vendor:publish --tag=laravel-errors

app-update-env:
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan config:clear

db:
	docker compose exec db $(CMD)

stop:
	docker compose stop
