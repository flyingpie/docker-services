#!/bin/bash

docker rm -f redis

docker run --name redis -d \
-v /var/docker/redis/data:/data \
redis
