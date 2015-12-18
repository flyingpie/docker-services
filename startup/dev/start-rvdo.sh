#!/bin/bash

source variables.sh

docker rm -f rvdo

docker run --name rvdo -d \
  -e VIRTUAL_HOST=rvdo.marcovandenoever.com \
  -v /var/docker/dev/www/rvdo:/app \
  -p 80 \
  --restart=always \
  tutum/apache-php
