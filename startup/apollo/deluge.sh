#!/bin/bash

source variables.sh

#docker pull jakexks/deluge-torrent-seedbox

#docker rm -f deluge

#docker run --name deluge -d \
#  -e VIRTUAL_HOST=torrents.flyingpie.nl \
#  -p 80 \
#  -p 8112:8112 \
#  -p 58846:58846 \
#  -p 58847:58847 \
#  -p 58847:58847/udp \
#  -v /var/docker/deluge:/home/deluge \
#  -v /media/:/media/ \
#  jakexks/deluge-torrent-seedbox

docker rm -f deluge

docker pull aostanin/deluge

docker run --name deluge -d \
  -e VIRTUAL_HOST=torrents.flyingpie.nl \
  -e VIRTUAL_PORT=8112 \
  -p 53160:53160 \
  -p 53160:53160/udp \
  -p 8112 \
  -p 58846 \
  -v /var/docker/deluge/data:/data \
  -v /media/:/media/ \
  --restart=always \
  aostanin/deluge

docker network create net-media
docker network connect net-media deluge
