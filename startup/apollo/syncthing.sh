#!/bin/bash

docker rm -f syncthing

docker pull tianon/syncthing

docker run --name syncthing -d \
  -p 8008:8384 \
  -p 22000:22000 \
  -p 21025:21025/udp \
  -v /var/backup/syncthing/config:/home/user/.config/syncthing \
  -v /var/docker:/home/user/docker-apollo:ro \
  -v /media/virtual/USB/Marco/Backup/docker-athena:/home/user/docker-athena \
  --restart always \
  tianon/syncthing
