#!/bin/bash

docker rm -f mongodb

docker run --name mongodb -d \
  -v /var/docker/mongodb:/data/db \
  --restart=always \
  mongo
