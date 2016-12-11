#!/bin/bash

source variables.sh

docker rm -f vcrfrontend

docker run --name vcrfrontend -d \
  -e VIRTUAL_HOST=vcr.marcovandenoever.com \
  -e ENVIRONMENT=production \
  -e API_URL=https://vcrapi.marcovandenoever.com \
  -e JWT_DOMAIN=$VCR_JWT_DOMAIN \
  -e JWT_CLIENTID=$VCR_JWT_CLIENTID \
  --restart=always \
  flyingpie/vcrfrontend
