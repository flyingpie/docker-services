#!/bin/bash

docker rm -f proxy
docker run --name proxy -d -p 80:80 -p 443:443 \
-v /var/docker/proxy/config:/etc/nginx/conf.d \
-v /var/docker/proxy/certs:/etc/nginx/certs \
-v /var/run/docker.sock:/tmp/docker.sock \
jwilder/nginx-proxy
