#!/bin/bash

source variables.sh

sudo mkdir /var/docker/owncloud
sudo chmod -R g+rw /var/docker/owncloud
sudo chgrp -R 33 /var/docker/owncloud

docker rm -f owncloud

docker pull l3iggs/owncloud

docker run --name owncloud -d \
  -e START_MYSQL=false \
  -e VIRTUAL_HOST=$VHOST_CLOUD \
  -p 80 \
  -v /var/docker/owncloud/config:/etc/webapps/owncloud/config \
  -v /var/docker/owncloud/data:/usr/share/webapps/owncloud/data \
  -v /var/docker/owncloud/owncloud.conf:/etc/httpd/conf/extra/owncloud.conf \
  --restart=always \
  l3iggs/owncloud

docker network create net-mail
docker network connect net-mail owncloud

docker network create net-mysql
docker network connect net-mysql owncloud
