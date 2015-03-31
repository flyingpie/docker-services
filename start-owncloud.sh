#!/bin/bash

sudo chmod -R g+rw /var/docker/owncloud
sudo chgrp -R 33 /var/docker/owncloud

docker rm -f owncloud
docker run --name owncloud -p 80 -d \
--link mysql:mysql \
-v /var/docker/owncloud/config:/etc/webapps/owncloud/config \
-v /var/docker/owncloud/data:/usr/share/webapps/owncloud/data \
-e VIRTUAL_HOST=owncloud.local \
l3iggs/owncloud
