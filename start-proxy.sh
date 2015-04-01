#!/bin/bash

docker rm -f proxy
docker run --name proxy -d \
  -p 80:80 \
  -p 443:443 \
  -v /var/docker/proxy/certs:/etc/nginx/certs \
  -v /var/docker/proxy/my_proxy.conf:/etc/nginx/conf.d/my_proxy.conf:ro \
  -v /var/run/docker.sock:/tmp/docker.sock \
  jwilder/nginx-proxy
