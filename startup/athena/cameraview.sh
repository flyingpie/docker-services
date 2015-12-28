#!/bin/bash

source variables.sh

docker rm -f cameraview

docker run --name cameraview -d \
  -e VIRTUAL_HOST=camera.van-den-oever.net \
  -e USERNAME=$CAMERAVIEW_USERNAME \
  -e PASSWORD=$CAMERAVIEW_PASSWORD \
  -v /var/docker/camerasync/output:/app/video \
  --restart=always \
  flyingpie/cameraview
