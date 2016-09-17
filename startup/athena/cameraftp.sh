#!/bin/bash

source variables.sh

docker pull emilybache/vsftpd-server

docker rm -f cameraftp

docker run --name cameraftp -d \
  -p 2021:21 \
  -p 2020:20 \
  -p 12020-12025:12020-12025 \
  -e USER=$CAMERAFTP_USER \
  -e PASS=$CAMERAFTP_PASS \
  -v /var/docker/cameraftp:/ftp \
  --restart=always \
  emilybache/vsftpd-server
