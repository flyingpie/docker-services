#!/bin/bash

docker pull ghost

docker rm -f flyingpie3

docker run --name flyingpie3 -d \
  -e VIRTUAL_HOST=www.flyingpie.nl \
  -e VIRTUAL_PORT=2368 \
  -v /var/docker/flyingpie3/instance:/var/lib/ghost \
  -v /var/docker/flyingpie3/index.js:/usr/src/ghost/index.js \
  -v /var/docker/flyingpie3/helpers.js:/usr/src/ghost/helpers.js \
  ghost
