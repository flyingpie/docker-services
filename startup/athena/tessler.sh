#!/bin/bash

source variables.sh

docker rm -f tessler

docker run --name tessler -d \
  -e VIRTUAL_HOST=tessler.flyingpie.nl \
  -v /var/docker/tessler/www:/app \
  --restart=always \
  tutum/apache-php
