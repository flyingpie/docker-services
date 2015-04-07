#!/bin/bash

source variables.sh

docker rm -f rsnapshot

docker run --name rsnapshot -d \
  -v /var/docker:/source \
  -v /home/marco/backup:/target \
  --restart=always \
  flyingpie/rsnapshot
