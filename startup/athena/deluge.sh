#!/bin/bash

source variables.sh

docker rm -f deluge

docker pull aostanin/deluge

docker run --name deluge -d \
  -e VIRTUAL_HOST=$VHOST_TORRENTS \
  -e VIRTUAL_PORT=8112 \
  -p 53160:53160 \
  -p 53160:53160/udp \
  -p 8112:8112 \
  -p 58846:58846 \
  -v /var/docker/deluge/data:/data \
  -v /media/:/media/ \
  --restart=always \
  aostanin/deluge
