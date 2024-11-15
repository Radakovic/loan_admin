migration:
	docker compose exec php php artisan migrate
migration_prev:
	docker compose exec php php artisan migrate:rollback
db_seed:
	docker compose exec php php artisan db:seed

