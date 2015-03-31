#!/bin/bash

docker rm -f dockerui

docker run --name dockerui -d \
  -p 9000 \
  --privileged \
  -e VIRTUAL_HOST=dockerui.local \
  -v /var/run/docker.sock:/var/run/docker.sock \
  dockerui/dockerui
