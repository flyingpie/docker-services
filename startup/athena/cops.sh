#!/bin/bash

source variables.sh

docker rm -f cops

docker run --name cops -d \
  -e VIRTUAL_HOST=books.flyingpie.nl \
  -v /var/docker/owncloud/data/marco/files/clientsync/Books/:/metadata/:ro \
  --restart=always \
  flyingpie/cops
