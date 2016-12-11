#!/bin/bash

sudo mkdir -p /var/docker/proxy
sudo touch /var/docker/proxy/proxy.conf

docker rm -f proxy

docker pull eforce21/letsencrypt-nginx-proxy

docker run --name proxy -d \
  -e LETSENCRYPT_EMAIL=marco@flyingpie.nl \
  -p 80:80 \
  -p 443:443 \
  -v /var/docker/proxy/certs:/etc/nginx/certs \
  -v /var/docker/proxy/htpasswd:/etc/nginx/htpasswd \
  -v /var/docker/proxy/proxy.conf:/etc/nginx/conf.d/proxy.conf \
  -v /var/docker/proxy/certs-ssl:/etc/letsencrypt/live \
  -v /var/run/docker.sock:/tmp/docker.sock \
  -v /etc/localtime:/etc/localtime:ro \
  --restart=always \
  eforce21/letsencrypt-nginx-proxy
