# Test application

Technical stack:
- PHP version 8.3
- Laravel version 11,
- MySQL
- PHPUnit + Paratest
- Docker

## 💿 Install process
In your terminal execute command to get source code of project
`git clone git@github.com:Radakovic/loan_admin.git`

This project uses Docker as working container for running application. To continue with installation you have to have installed
Docker and Docker Compose.

After you clone project execute one of fallowing commands needed for start project:
- `cd loan_admin`
- `docker compose up`
- `make run`

Execution of command will last for long time but only for the first time.
It is because execution of this command has couple stages:
- Pull all required services
- Install all required PHP extensions

Next execute this commands in this order:

- `docker compose exec php composer install`
- `docker compose exec php php artisan env:decrypt`
- `npm install`
- `npm run build`
- `docker compose exec php php artisan migrate` or `make migration`
- `docker compose exec php php artisan db:seed` or `make db_seed`

After completing the installation, your application will run on this port: `http://localhost:8082/login`

## 💿 Login to app

For login to application you can use any Adviser from database, but you can also use this account:

- email: adviser@example.com
- password: password

All accounts use same password: `password`

## ✨ Make commands
- `make run` run project using docker
- `make stop` docker down containers
- `make down` docker down containers with dropping database and cleaning volumes
- `make migration` execute migrations
- `make migration_prev` revert latest migration
- `db_seed` generate fixture data
- `make test` run all PHPUnit tests - paratest
- `make test_coverage` run tests with coverage - paratest

## ✨ Execute tests
- `make test` run all PHPUnit tests - paratest
- `make test_coverage` run tests with coverage - paratest

If you execute tests with coverage it will generate html with data. Path to html: `./html-coverage/index.html`

## 💡 Database access top secret ;-)

- MYSQL_HOST: 127.0.0.2:3306
- MYSQL_PASSWORD: password
- MYSQL_USER: app_user
- MYSQL_DATABASE: loan_admin
