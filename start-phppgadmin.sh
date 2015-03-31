#!/bin/bash

docker rm -f phppgadmin

docker run --name phppgadmin -d \
--link postgresql:postgresql \
-e VIRTUAL_HOST=phppgadmin.local \
maxexcloo/phppgadmin
