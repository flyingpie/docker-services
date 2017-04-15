#!/bin/bash

docker run --rm -it \
  --name toolbox \
  -v $PWD:/pwd \
  -v /:/$HOSTNAME \
  -v /var/run/docker.sock:/var/run/docker.sock \
  --network host \
  flyingpie/toolbox
