#!/bin/bash

source variables.sh

docker pull timhaak/couchpotato

docker rm -f couchpotato

docker run --name couchpotato -d \
  -e VIRTUAL_HOST=movies.flyingpie.nl \
  -e VIRTUAL_PORT=5050 \
  -v /var/docker/couchpotato/config:/config \
  -v /media:/media \
  -p 5050:5050 \
  --restart=always \
  timhaak/couchpotato

docker network create net-media
docker network connect net-media couchpotato
