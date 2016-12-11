#!/bin/bash

docker pull linuxserver/plex

docker rm -f plex

docker run --name plex -d \
  -e VERSION=latest \
  -e PUID=1000 \
  -e PGID=1000 \
  -p 32400:32400 \
  -p 32400:32400/udp \
  -p 32469:32469 \
  -p 32469:32469/udp \
  -p 5353:5353/udp \
  -p 1900:1900/udp \
  -v /var/plex:/config \
  -v /media:/media \
  -v /media/transcode:/transcode \
  linuxserver/plex
