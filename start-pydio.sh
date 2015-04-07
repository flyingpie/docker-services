#!/bin/bash

source variables.sh

docker rm -f pydio

docker run --name pydio -d \
  --link mysql:mysql \
  -e VIRTUAL_HOST=$VHOST_CLOUD \
  -e PYDIO_VERSION=6.0.5 \
  -p 80 \
  -v /var/docker/pydio/data/files:/var/www/pydio/data/files \
  -v /var/docker/pydio/data/personal:/var/www/pydio/data/personal \
  --restart=always \
  flyingpie/pydio
