#!/bin/bash

source variables.sh

docker pull linuxserver/sonarr

docker rm -f sonarr

docker run --name sonarr -d \
  -e VIRTUAL_HOST=tv.flyingpie.nl \
  -e VIRTUAL_PORT=8989 \
  -v /dev/rtc:/dev/rtc:ro \
  -v /var/docker/sonarr:/config \
  -v /media/:/media \
  -p 8989:8989 \
  --restart=always \
  linuxserver/sonarr

docker network create net-media
docker network connect net-media sonarr
