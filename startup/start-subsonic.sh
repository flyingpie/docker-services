#!/bin/bash

source variables.sh

docker rm -f subsonic

docker run --name subsonic -d \
  -e VIRTUAL_HOST=$VHOST_MUSIC \
  -p 4040 \
  -v /var/docker/subsonic/data:/data \
  -v /media/music:/music \
  aostanin/subsonic
