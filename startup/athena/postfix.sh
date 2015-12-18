#!/bin/bash

docker rm -f smtp

docker pull catatnight/postfix

docker run --name postfix -d \
  -e maildomain=flyingpie.nl \
  -e smtp_user=user:pwd \
  -p 25:25 \
  --restart=always \
  catatnight/postfix

docker network create net-mail
docker network connect net-mail postfix
