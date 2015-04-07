#!/bin/bash

source variables.sh

docker rm -f phppgadmin

docker run --name phppgadmin -d \
  --link postgresql:postgresql \
  -e VIRTUAL_HOST=$VHOST_PHPPGADMIN \
  --restart=always \
  maxexcloo/phppgadmin
