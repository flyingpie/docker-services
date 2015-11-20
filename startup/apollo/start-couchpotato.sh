#!/bin/bash

source variables.sh

docker pull timhaak/couchpotato

docker rm -f couchpotato

docker run --name couchpotato -d \
  -e VIRTUAL_HOST=$VHOST_COUCHPOTATO \
  -v /var/docker/couchpotato/config:/config \
  -v /media:/media \
  -p 5050 \
  --restart=always \
  timhaak/couchpotato
