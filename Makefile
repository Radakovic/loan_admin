run:
	@docker compose up
stop:
	@docker compose down
down:
	@docker compose down --remove-orphans --volumes
migration:
	docker compose exec php php artisan migrate
migration_prev:
	docker compose exec php php artisan migrate:rollback
db_seed:
	docker compose exec php php artisan db:seed
test:
	@docker compose exec php vendor/bin/paratest
test_coverage:
	@docker compose exec php vendor/bin/paratest -p 4 --runner=WrapperRunner --coverage-html=html-coverage --log-junit=junit.xml --coverage-cobertura=cobertura.xml --coverage-clover=coverage-clover.xml


