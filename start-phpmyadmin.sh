#!/bin/bash

docker rm -f phpmyadmin
docker run --name phpmyadmin -d \
--link mysql:mysql \
-e MYSQL_USERNAME=root \
-e MYSQL_PASSWORD=mysql \
-e VIRTUAL_HOST=phpmyadmin.local \
-p 80 \
corbinu/docker-phpmyadmin
