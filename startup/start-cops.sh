#!/bin/bash

source variables.sh

docker rm -f cops

docker run --name cops -it \
  -p 80 \
  flyingpie/cops
