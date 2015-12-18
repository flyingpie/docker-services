#!/bin/bash

docker rm -f ghost

docker run --name ghost -d \
  -e VIRTUAL_HOST=ghost.marcovandenoever.com \
  -v /var/docker/ghost/blog:/var/lib/ghost \
  --restart=always \
  ghost
