#!/bin/bash

source variables.sh

docker rm -f fileserver

docker run --name fileserver -d \
  -e VIRTUAL_HOST=files.flyingpie.nl \
  -v /var/docker/fileserver:/app \
  --restart=always \
  tutum/apache-php
