#!/bin/bash

source variables.sh

docker pull phpmyadmin/phpmyadmin

docker rm -f phpmyadmin

docker run --name phpmyadmin -d \
  --link mysql:mysql \
  -e PMA_HOST=mysql \
  -e VIRTUAL_HOST=phpmyadmin.flyingpie.nl \
  --restart=always \
  phpmyadmin/phpmyadmin
