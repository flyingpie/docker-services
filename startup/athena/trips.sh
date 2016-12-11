#!/bin/bash

docker pull ghost

docker rm -f trips

docker run --name trips -d \
  -e VIRTUAL_HOST=trips.marcovandenoever.com \
  -e VIRTUAL_PORT=2368 \
  -v /var/docker/trips:/var/lib/ghost \
  --restart=always \
  ghost
