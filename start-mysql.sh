#!/bin/bash

docker rm -f mysql

docker run --name mysql -d \
-e MYSQL_ROOT_PASSWORD=mysql \
-v /var/docker/mysql/data:/var/lib/mysql \
mysql:latest
