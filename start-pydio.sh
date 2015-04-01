#!/bin/bash

docker rm -f pydio

docker run --name pydio -d \
  --link mysql:mysql \
  -e VIRTUAL_HOST=pydio.local \
  -e PYDIO_VERSION=6.0.5 \
  -p 80 \
  -v /var/docker/pydio/data/files:/var/www/pydio/data/files \
  -v /var/docker/pydio/data/personal:/var/www/pydio/data/personal \
  flyingpie/pydio
