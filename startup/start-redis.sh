#!/bin/bash

source variables.sh

docker rm -f redis

docker run --name redis -d \
  -v /var/docker/redis/data:/data \
  --restart=always \
  redis
