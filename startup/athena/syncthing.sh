#!/bin/bash

docker rm -f syncthing

docker pull istepanov/syncthing

docker run --name syncthing -d \
  -p 8008:8384 \
  -p 22000:22000 \
  -p 21025:21025/udp \
  -v /var/backup/syncthing/config:/home/syncthing/.config/syncthing \
  -v /var/docker:/home/syncthing/docker-athena \
  -v /var/backup/docker-apollo:/home/syncthing/docker-apollo \
  istepanov/syncthing
