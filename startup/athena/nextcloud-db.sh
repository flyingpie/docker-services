#!/bin/bash

docker pull mariadb:10

docker rm -f nextcloud_db

docker run --name nextcloud_db -d \
  -e MYSQL_ROOT_PASSWORD=dn3jtc0NzxebfSHg9fDF \
  -e MYSQL_DATABASE=nextcloud \
  -e MYSQL_USER=nextcloud \
  -e MYSQL_PASSWORD=O3pALH4X3dMzjG94Mphz \
  -v /var/docker/nextcloud/db:/var/lib/mysql \
  --restart=always \
  mariadb:10
