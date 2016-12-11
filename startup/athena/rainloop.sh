#!/bin/bash

docker pull ahmet2mir/rainloop

docker rm -f rainloop

docker run --name rainloop -d \
  -e VIRTUAL_HOST=mail.flyingpie.nl \
  -v /var/docker/rainloop:/webapps/rainloop/data \
  --restart=always \
  ahmet2mir/rainloop
