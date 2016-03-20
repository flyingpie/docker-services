#!/bin/bash

source variables.sh

docker rm -f flyingpie

docker run --name flyingpie -d \
  -e VIRTUAL_HOST=www.flyingpie.nl \
  -v /var/docker/flyingpie.nl:/usr/local/apache2/htdocs/ \
  --restart=always \
  httpd
