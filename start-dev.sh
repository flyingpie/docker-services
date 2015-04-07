#!/bin/bash

source variables.sh

docker rm -f dev

docker run --name dev -d \
  -e VIRTUAL_HOST=$VHOST_DEV \
  -p 80 \
  -v /var/docker/dev/www:/app \
  --restart=always \
  tutum/apache-php
