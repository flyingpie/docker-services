#!/bin/bash

source variables.sh

docker rm -f phpmyadmin

docker run --name phpmyadmin -d \
  --link mysql:mysql \
  -e MYSQL_USERNAME=$MYSQL_ROOT_USER \
  -e MYSQL_PASSWORD=$MYSQL_ROOT_PASSWORD \
  -e VIRTUAL_HOST=phpmyadmin.flyingpie.nl \
  --restart=always \
  corbinu/docker-phpmyadmin
