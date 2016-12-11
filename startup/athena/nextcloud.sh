#!/bin/bash

docker pull wonderfall/nextcloud

docker rm -f nextcloud

docker run --name nextcloud -d \
  -e UID=1001 \
  -e GID=1001 \
  -e VIRTUAL_HOST=cloud.flyingpie.nl \
  -v /var/docker/nextcloud/data:/data \
  -v /var/docker/nextcloud/config:/config \
  -v /var/docker/nextcloud/apps:/apps2 \
  --link nextcloud_db:nextcloud_db \
  --restart=always \
  wonderfall/nextcloud
