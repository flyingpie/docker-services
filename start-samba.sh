#!/bin/bash

docker rm -f samba

docker run --name samba -d \
  -P \
  -v $(which docker):/docker \
  -v /var/run/docker.sock:/docker.sock \
  -v /media:/Media:ro \
  svendowideit/samba samba
