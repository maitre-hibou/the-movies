SAIL_EXEC=./vendor/bin/sail

build:
	${SAIL_EXEC} build --no-cache

prepare:
	composer install
	@if [ ! -f .env ]; then \
		cp .env.example .env; \
		php artisan key:generate --ansi; \
	fi

.PHONY: build down prepare

down: prepare
	-docker network disconnect the-movies_sail local_proxy
	${SAIL_EXEC} down -v --remove-orphans

install:
	${SAIL_EXEC} artisan migrate
	${SAIL_EXEC} npm install
	${SAIL_EXEC} npm run build

start: prepare build
	${SAIL_EXEC} up -d --force-recreate
	-docker network connect the-movies_sail local_proxy

.PHONY: down install start
