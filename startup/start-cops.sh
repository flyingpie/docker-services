#!/bin/bash

source variables.sh

docker rm -f cops

docker run --name cops -d \
  -e VIRTUAL_HOST=$VHOST_BOOKS \
  -p 80 \
  -v /var/docker/owncloud/data/marco/files/clientsync/Books/:/metadata/ \
  flyingpie/cops
