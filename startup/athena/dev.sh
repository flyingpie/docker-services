#!/bin/bash

source variables.sh

docker rm -f dev

docker run --name dev -d \
  -e VIRTUAL_HOST=dev.flyingpie.nl \
  -v /var/docker/dev/www:/app \
  --restart=always \
  tutum/apache-php
