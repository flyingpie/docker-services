#!/bin/bash

docker rm -f samba

docker run --name samba -d \
  --net=host \
  -p 137:137 \
  -p 138:138 \
  -p 139:139 \
  -p 445:445 \
  -v /var/docker/samba/smb.conf:/etc/samba/smb.conf \
  -v /media:/media \
  flyingpie/samba
