#!/bin/bash

source variables.sh

docker rm -f mysql

docker run --name mysql -d \
  -e MYSQL_ROOT_PASSWORD=$MYSQL_ROOT_PASSWORD \
  -v /var/docker/mysql/data:/var/lib/mysql \
  --restart=always \
  mysql:latest

docker network create net-mysql
docker network connect net-mysql mysql
