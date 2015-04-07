#!/bin/bash

source variables.sh

docker rm -f sabnzbd

docker run --name sabnzbd -d \
  -h 0.0.0.0 \
  -e VIRTUAL_HOST=$VHOST_SABNZBD \
  -e VIRTUAL_PORT=8080 \
  -v /var/docker/sabnzbd/config:/config \
  -v /var/docker/sabnzbd/downloads:/data \
  -v /media:/media \
  -p 8080 \
  -p 9090 \
  --restart=always \
  timhaak/sabnzbd
