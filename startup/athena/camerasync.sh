#!/bin/bash

source variables.sh

docker rm -f camerasync

docker run --name camerasync -d \
  -e HOST=cameraftp \
  -e PORT=21 \
  -e USER=$CAMERAFTP_USER \
  -e PASS=$CAMERAFTP_PASS \
  -e DIR=/ftp/camera/FI9804W_00626E4FBE01/record \
  -v /var/docker/camerasync/output:/output \
  --link cameraftp:cameraftp \
  --restart=always \
  flyingpie/camerasync:latest
