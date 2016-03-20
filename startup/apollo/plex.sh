#!/bin/bash

docker pull timhaak/plex

docker rm -f plex

docker run --name plex -d \
  -v /var/docker/plex:/config \
  -v /:/data \
  -p 32400:32400 \
  --net host \
  --restart always \
  timhaak/plex
