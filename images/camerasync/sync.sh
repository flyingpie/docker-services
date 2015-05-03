#!/bin/bash

ncftpget \
  -f /login.cfg \
  -R -T -DD -d log.log \
  /dl /camera/FI9804W_00626E4FBE01/record

cd /dl/record
for i in *.mkv; do avconv -i $i -codec copy -y $i.mp4 -loglevel error; rm $i; done

mv /dl/record/*.mp4 /output
