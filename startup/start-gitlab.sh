#!/bin/bash

source variables.sh

docker rm -f gitlab

docker run --name=gitlab -d \
  --link postgresql:postgresql \
  --link redis:redisio \
  -e GITLAB_PORT=80 \
  -e GITLAB_SSH_PORT=10022 \
  -e GITLAB_HOST=$VHOST_GITLAB \
  -e 'GITLAB_HTTPS=true' \
  -e 'SSL_SELF_SIGNED=true' \
  -e 'VIRTUAL_HOST=gitlab.local' \
  -e 'DB_NAME=gitlabhq_production' \
  -e 'DB_USER=gitlab' \
  -e 'DB_PASS=password' \
  -p 10080:80 \
  -p 10022:22 \
  -v /var/docker/gitlab/data:/home/git/data \
  -v /var/run/docker.sock:/run/docker.sock \
  -v $(which docker):/bin/docker \
  --restart=always \
  sameersbn/gitlab:7.9.1
