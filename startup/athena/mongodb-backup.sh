#!/bin/bash

docker rm -f mongodb-backup

docker run --name mongodb-backup -d \
  -e INIT_BACKUP=1 \
  -v /var/docker/mongodb-backup:/backup \
  --link mongodb \
  --restart=always \
  tutum/mongodb-backup
