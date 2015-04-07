#!/bin/bash

source variables.sh

docker rm -f tessler

docker run --name tessler -d \
  -e VIRTUAL_HOST=$VHOST_TESSLER \
  -p 80 \
  -v /var/docker/tessler/www:/app \
  --restart=always \
  tutum/apache-php
