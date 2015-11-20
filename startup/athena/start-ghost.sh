#!/bin/bash

docker rm -f ghost

docker run --name ghost -d \
  -e VIRTUAL_HOST=ghost.marcovandenoever.com \
  -p 2368 \
  -v /var/docker/ghost/blog:/var/lib/ghost \
  --restart=always \
  ghost
