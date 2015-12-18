#!/bin/bash

source variables.sh

docker pull gogs/gogs

docker run --name gogs -d \
  -e VIRTUAL_HOST=git.flyingpie.nl \
  -e VIRTUAL_PORT=3000 \
  -p 3000 \
  -p 22:22 \
  -v /var/docker/gogs:/data \
  --restart=always \
  gogs/gogs

docker network create net-mail
docker network connect net-mail gogs

docker network create net-mysql
docker network connect net-mysql gogs
