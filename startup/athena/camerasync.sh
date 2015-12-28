#!/bin/bash

source variables.sh

docker rm -f camerasync

docker run --name camerasync -d \
  -e HOST=cameraftp \
  -e PORT=21 \
  -e USER=$CAMERAFTP_USER \
  -e PASS=$CAMERAFTP_PASSWORD \
  -e DIR=/ftp/camera/FI9804W_00626E4FBE01/record \
  -v /var/docker/camerasync/output:/output \
  --restart=always \
  flyingpie/camerasync:latest

docker network create net-cameraftp
docker network connect net-cameraftp camerasync
