#!/bin/bash

docker rm -f postgresql

docker run --name postgresql -d \
-v /var/docker/postgresql/data:/var/lib/postgresql/data \
-e POSTGRES_USER=marco \
-e POSTGRES_PASSWORD=postgres \
postgres
