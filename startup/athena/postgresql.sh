#!/bin/bash

source variables.sh

docker rm -f postgresql

docker run --name postgresql -d \
  -v /var/docker/postgresql/data:/var/lib/postgresql/data \
  -e POSTGRES_USER=$POSTGRES_ROOT_USER \
  -e POSTGRES_PASSWORD=$POSTGRES_ROOT_PASSWORD \
  --restart=always \
  postgres
