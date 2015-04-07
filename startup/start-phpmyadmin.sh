#!/bin/bash

source variables.sh

docker rm -f phpmyadmin

docker run --name phpmyadmin -d \
  --link mysql:mysql \
  -e MYSQL_USERNAME=$MYSQL_ROOT_USER \
  -e MYSQL_PASSWORD=$MYSQL_ROOT_PASSWORD \
  -e VIRTUAL_HOST=$VHOST_PHPMYADMIN \
  -p 80 \
  --restart=always \
  corbinu/docker-phpmyadmin
