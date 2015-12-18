#!/bin/bash

source variables.sh

docker rm -f rss

docker pull flyingpie/ttrss

docker run --name rss -d \
  --link postgresql:db \
  -e VIRTUAL_HOST=rss.flyingpie.nl \
  -e DB_NAME=$POSTGRES_TTRSS_DB \
  -e DB_USER=$POSTGRES_TTRSS_USER \
  -e DB_PASS=$POSTGRES_TTRSS_PASSWORD \
  --restart=always \
  flyingpie/ttrss

docker network create net-pgsql
docker network connect net-pgsql rss
