#!/bin/bash

source variables.sh

sudo mkdir /var/docker/owncloud
sudo chmod -R g+rw /var/docker/owncloud
sudo chgrp -R 33 /var/docker/owncloud

docker rm -f owncloud

docker run --name owncloud -d \
  --link mysql:mysql \
  -e VIRTUAL_HOST=$VHOST_CLOUD \
  -p 80 \
  -v /var/docker/owncloud/config:/etc/webapps/owncloud/config \
  -v /var/docker/owncloud/data:/usr/share/webapps/owncloud/data \
  --restart=always \
  flyingpie/owncloud
