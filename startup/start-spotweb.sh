#!/bin/bash

source variables.sh

docker rm -f spotweb

docker run --name spotweb -d \
  --link mysql:mysql \
  -e VIRTUAL_HOST=$VHOST_SPOTWEB \
  -p 80 \
  -v /var/docker/spotweb/config/dbsettings.inc.php:/var/www/site/spotweb/dbsettings.inc.php \
  --restart=always \
  andyverbunt/docker-spotweb
