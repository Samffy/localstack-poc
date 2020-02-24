build:
	set -a
	. ./.env
	set +a
	sudo docker-compose build

start:
	sudo docker-compose up

stop:
	sudo docker-compose down

shell:
	sudo docker exec -it localstack-poc_php-fpm_1 bash
