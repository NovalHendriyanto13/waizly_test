The application using docker setup to run, but you can run it whithout docker as well. The application run in PHP 8.1 and MYSQL. if you have an issue in connecting database in docker, please set HOST into "host.internal.docker" in .env file
## How TO SET UP APPLICATION

- type "docker-compose build" on your cmd
- type "docker-compose up"
- type "docker ps" to check docker container name
- type "docker exec -it backend /bin/bash" to enter the container of docker
- type "composer update"
- and then type "exit" to exit docker 

## HOW TO SHUT DOWN APPLICATION

- type "docker-compose down"
- type "docker-compose stop"

## BASIC TEST
    Basic Test documentation is in "notes" folder