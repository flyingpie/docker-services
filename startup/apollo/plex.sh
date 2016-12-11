#!/bin/bash

docker pull timhaak/plex

docker rm -f plex

docker run --name plex -d \
  -e PLEX_DISABLE_SECURITY=0 \
  -e PLEX_USERNAME=the_mad_man \
  -e PLEX_PASSWORD=MBGqAepdKxSJSMWaslLH \
  -v /var/docker/plex:/config \
  -v /:/data \
  -p 32400:32400 \
  --restart always \
  timhaak/plex
