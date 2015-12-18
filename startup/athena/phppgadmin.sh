#!/bin/bash

source variables.sh

docker rm -f phppgadmin

docker run --name phppgadmin -d \
  -e VIRTUAL_HOST=phppgadmin.flyingpie.nl \
  --restart=always \
  maxexcloo/phppgadmin

docker network create net-pgsql
docker network connect net-pgsql phppgadmin
