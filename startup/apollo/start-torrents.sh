#!/bin/bash

source variables.sh

docker rm -f torrents

docker run --name torrents -d \
  -e VIRTUAL_HOST=torrents.flyingpie.nl \
  -e VIRTUAL_PORT=8112 \
  -p 80 \
  -p 8112:8112 \
  -p 58846:58846 \
  -p 58847:58847 \
  -p 58847:58847/udp \
  -v /var/docker/deluge:/home/deluge \
  -v /media/:/media/ \
  jakexks/deluge-torrent-seedbox
