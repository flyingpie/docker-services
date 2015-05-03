#!/bin/bash

source variables.sh

docker rm -f subsonic

docker run --name subsonic -d \
  -e VIRTUAL_HOST=$VHOST_MUSIC \
  -p 4040 \
  -v /media/virtual/Music:/music \
  mschuerig/debian-subsonic
