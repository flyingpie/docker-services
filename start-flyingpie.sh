#!/bin/bash

source variables.sh

docker rm -f flyingpie-cmsms

docker run --name flyingpie-cmsms -d \
  -e MYSQL_HOST=mysql \
  -e MYSQL_USER=$MYSQL_CMSMS_USER \
  -e MYSQL_PASS=$MYSQL_CMSMS_PASSWORD \
  -e MYSQL_DB=$MYSQL_CMSMS_DB \
  -e VIRTUAL_HOST=$VHOST_FLYINGPIE \
  --link mysql:mysql \
  -p 80 \
  --restart=always \
  flyingpie/flyingpie-cmsms
