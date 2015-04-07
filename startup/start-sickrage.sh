#!/bin/bash

source variables.sh

docker rm -f sickrage

docker run --name sickrage -d \
  -e VIRTUAL_HOST=$VHOST_SICKRAGE \
  -h 0.0.0.0 \
  -v /var/docker/sickrage/config:/config \
  -v /media:/media \
  -p 8081 \
  --restart=always \
  timhaak/sickrage
