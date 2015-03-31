#!/bin/bash

docker rm -f fileserver

docker run --name fileserver -d \
  -e VIRTUAL_HOST=fileserver.local \
  -v /var/docker/fileserver:/app \
  -p 80 \
  tutum/apache-php
