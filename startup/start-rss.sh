#!/bin/bash

source variables.sh

docker rm -f rss

docker run --name rss -d \
  --link postgresql:db \
  -p 80 \
  -e VIRTUAL_HOST=$VHOST_RSS \
  -e DB_NAME=$POSTGRES_TTRSS_DB \
  -e DB_USER=$POSTGRES_TTRSS_USER \
  -e DB_PASS=$POSTGRES_TTRSS_PASSWORD \
  --restart=always \
  flyingpie/ttrss
