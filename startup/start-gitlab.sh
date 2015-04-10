#!/bin/bash

source variables.sh

docker rm -f gitlab

docker run --name=gitlab -d \
  --link postgresql:postgresql \
  --link redis:redisio \
  -e GITLAB_PORT=443 \
  -e GITLAB_SSH_PORT=22 \
  -e GITLAB_HOST=$VHOST_GITLAB \
  -e GITLAB_HTTPS=true \
  -e VIRTUAL_HOST=$VHOST_GITLAB \
  -e DB_NAME=$POSTGRES_GITLAB_DB \
  -e DB_USER=$POSTGRES_GITLAB_USER \
  -e DB_PASS=$POSTGRES_GITLAB_PASSWORD \
  -e SMTP_USER=marco@flyingpie.nl \
  -e SMTP_PASS=11070d11f3 \
  -e SMTP_DOMAIN=flyingpie.nl \
  -e SMTP_HOST=smtp.strato.com \
  -p 80 \
  -p 22:22 \
  -v /var/docker/gitlab/data:/home/git/data \
  -v /var/run/docker.sock:/run/docker.sock \
  -v $(which docker):/bin/docker \
  --restart=always \
  sameersbn/gitlab:7.9.1
