#!/bin/bash

docker rm -f postfix

docker pull catatnight/postfix

docker run --name postfix -d \
  -e maildomain=flyingpie.nl \
  -e smtp_user=user:pwd \
  --restart=always \
  catatnight/postfix

docker network create net-mail
docker network connect net-mail postfix
