#!/bin/bash

source variables.sh

docker rm -f flyingpie-cmsms

docker run --name flyingpie-cmsms -d \
  -e MYSQL_HOST=mysql \
  -e MYSQL_USER=$MYSQL_CMSMS_USER \
  -e MYSQL_PASS=$MYSQL_CMSMS_PASSWORD \
  -e MYSQL_DB=$MYSQL_CMSMS_DB \
  -e VIRTUAL_HOST=old.marcovandenoever.com \
  --link mysql:mysql \
  --restart=always \
  flyingpie/flyingpie-cmsms
