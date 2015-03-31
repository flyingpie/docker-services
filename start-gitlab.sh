#!/bin/bash

docker rm -f gitlab

docker run --name=gitlab -d \
-e 'GITLAB_PORT=80' \
-e 'GITLAB_SSH_PORT=10022' \
-e 'GITLAB_HOST=gitlab.local' \
-e 'GITLAB_HTTPS=true' \
-e 'SSL_SELF_SIGNED=true' \
-e 'VIRTUAL_HOST=gitlab.local' \
-e 'DB_NAME=gitlabhq_production' \
-e 'DB_USER=gitlab' \
-e 'DB_PASS=password' \
-p 10080:80 -p 10022:22 \
--link postgresql:postgresql \
--link redis:redisio \
-v /var/docker/gitlab/data:/home/git/data \
-v /var/run/docker.sock:/run/docker.sock \
-v $(which docker):/bin/docker \
sameersbn/gitlab:7.9.1
