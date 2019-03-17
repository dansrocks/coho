PHP_CONTAINER = php-fpm


# Based on https://github.com/machuga/laravel-io/blob/master/Makefile

# Usage information
# Use: make all
all:
	@echo "DummyTool for lazy developers."

	@echo "\nArtisan"
	@echo "  make migrate          - Ejecuta 'migrate' en el contenedor de PHP"
	@echo "  make rollback         - Ejecuta 'migrate:rollback' en el contenedor de PHP"
	@echo "  make seed             - Seed database. Called automatically with 'make vagrant'"

	@echo "\nComposer"
	@echo "  make composer-download        - Download and install composer."

# Give help
# Use: make help
help: all

make migrate:
	docker-compose exec $(PHP_CONTAINER) php artisan migrate

make rollback:
	docker-compose exec $(PHP_CONTAINER) php artisan migrate:rollback
