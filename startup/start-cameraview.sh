#!/bin/bash

source variables.sh

docker rm -f cameraview

docker run --name cameraview -d \
  -e VIRTUAL_HOST=$VHOST_CAMERA \
  -e USERNAME=$CAMERA_USERNAME \
  -e PASSWORD=$CAMERA_PASSWORD \
  -p 80 \
  -v /var/docker/camerasync/output:/app/video \
  flyingpie/cameraview
