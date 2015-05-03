#!/bin/bash

source variables.sh

docker rm -f camerasync

docker run --name camerasync -d \
  -v /var/docker/camerasync/output:/output \
  -v /var/docker/camerasync/login.cfg:/login.cfg:ro \
  flyingpie/camerasync:latest
