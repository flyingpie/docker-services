#!/bin/bash

source variables.sh

docker pull timhaak/sabnzbd

docker rm -f sabnzbd

docker run --name sabnzbd -d \
  -h 0.0.0.0 \
  -e VIRTUAL_HOST=$VHOST_SABNZBD \
  -e VIRTUAL_PORT=8080 \
  -v /var/docker/sabnzbd/config:/config \
  -v /var/docker/sabnzbd/downloads:/data \
  -v /media:/media \
  -p 8080 \
  --restart=always \
  timhaak/sabnzbd

docker network create net-media
docker network connect net-media sabnzbd
