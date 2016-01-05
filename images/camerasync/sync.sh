#!/bin/bash

cd /

mkdir -p /dl/record

ncftpget \
  -P $PORT \
  -u $USER \
  -p $PASS \
  -R -T -DD -d log.log \
  $HOST \
  /dl $DIR

cd /dl/record

for i in *.mkv; do avconv -i $i -y $i.mp4 -loglevel error; rm $i; done

mv /dl/record/*.mp4 /output

find /output/* -mtime +5 -exec rm {} \;
