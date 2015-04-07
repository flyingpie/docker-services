#!/bin/bash

source variables.sh

docker rm -f fileserver

docker run --name fileserver -d \
  -e VIRTUAL_HOST=$VHOST_FILESERVER \
  -v /var/docker/fileserver:/app \
  -p 80 \
  --restart=always \
  tutum/apache-php
