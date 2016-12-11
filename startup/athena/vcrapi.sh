#!/bin/bash

source variables.sh

docker rm -f vcrapi

docker run --name vcrapi -d \
  -e VIRTUAL_HOST=vcrapi.marcovandenoever.com \
  -e DB_URL=mongodb://mongodb:27017 \
  -e DB_NAME=vcr \
  -e JWT_ISSUER=$VCR_JWT_ISSUER \
  -e JWT_AUDIENCE=$VCR_JWT_AUDIENCE \
  -e JWT_SECRET=$VCR_JWT_SECRET \
  --link mongodb \
  --restart=always \
  flyingpie/vcrapi
