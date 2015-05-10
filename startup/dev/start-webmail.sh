#!/bin/bash

source variables.sh

docker rm -f webmail

docker run --name webmail -d \
  -e VIRTUAL_HOST=$VHOST_WEBMAIL \
  --link mysql:mysql \
  -p 80 \
  -v /var/docker/webmail/data:/app/webmail/data \
  flyingpie/afterlogic
