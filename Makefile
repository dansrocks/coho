PHP_CONTAINER = php-fpm


# Based on https://github.com/machuga/laravel-io/blob/master/Makefile

# Usage information
# Use: make all
all:
	@echo "DummyTool for lazy developers."

	@echo "\nArtisan"
	@echo "  make migrate          - Launches a migration command on your vagrantbox. Called automatically with 'make vagrant'"
	@echo "  make rollback         - Launches a rollback command on your vagrantbox."
	@echo "  make seed             - Seed database. Called automatically with 'make vagrant'"

	@echo "\nComposer"
	@echo "  make composer-download        - Download and install composer."

# Give help
# Use: make help
help: all

make migrate:
	docker-compose exec $(PHP_CONTAINER) php artisan migrate
