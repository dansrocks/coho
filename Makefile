PHP_CONTAINER = php-fpm
COMPOSER_CONTAINER = composer
NODE_CONTAINER = node:10.15-alpine


# Based on https://github.com/machuga/laravel-io/blob/master/Makefile

# Usage information
# Use: make all
all:
	@echo "DummyTool for lazy developers."

	@echo "\nArtisan"
	@echo "  make migrate          - Ejecuta 'migrate' en el contenedor de PHP"
	@echo "  make rollback         - Ejecuta 'migrate:rollback' en el contenedor de PHP"
	@echo "  make seed             - Seed database"

	@echo "\nComposer"
	@echo "  make composer         - Execute composer install"

# Give help
# Use: make help
help: all

make migrate:
	@docker-compose exec $(PHP_CONTAINER) php artisan migrate

make rollback:
	@docker-compose exec $(PHP_CONTAINER) php artisan migrate:rollback

make seed:
	@docker-compose exec $(PHP_CONTAINER) php artisan db:seed

make clear:
	@docker-compose exec $(PHP_CONTAINER) php artisan view:clear

make composer:
	@docker-compose up $(COMPOSER_CONTAINER)

make npm:
	@docker-compose run $(NODE_CONTAINER)
