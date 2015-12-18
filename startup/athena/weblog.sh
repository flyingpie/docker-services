#!/bin/bash

source variables.sh

docker rm -f weblog

docker run --name weblog -d \
  -e VIRTUAL_HOST=marcovandenoever.com \
  -e ROOT_FOLDER=jekyll/_site \
  -p 2222:22 \
  -v /var/docker/marcovandenoever.com/ssh:/root/.ssh \
  --restart=always \
  flyingpie/apache-php-git
