#!/bin/bash

source variables.sh

docker rm -f webmail

docker run --name webmail -d \
  -e VIRTUAL_HOST=$VHOST_WEBMAIL \
  --link mysql:mysql \
  --link mailserver:mailserver \
  -p 80 \
  -v /var/docker/afterlogic/data:/app/webmail/data \
  flyingpie/afterlogic
