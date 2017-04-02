#!/bin/bash

source variables.sh

docker rm -f cops

docker run --name cops -d \
  -e VIRTUAL_HOST=books.flyingpie.nl \
  -v /var/docker/cops/config:/config \
  -v /var/docker/nextcloud/data/marco/files/clientsync/Books/:/books:ro \
  --restart=always \
  linuxserver/cops
