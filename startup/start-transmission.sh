#!/bin/bash

source variables.sh

docker rm -f transmission

docker run --name transmission -d \
  -e VIRTUAL_HOST=$VHOST_TRANSMISSION \
  -e TRUSER=$TRANSMISSION_USER \
  -e TRPASSWD=$TRANSMISSION_PASSWORD \
  -v /media/virtual/Download/Complete:/var/lib/transmission-daemon/downloads \
  -p 9091 \
  --restart=always \
  dperson/transmission
