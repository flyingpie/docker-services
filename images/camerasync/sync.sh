#!/bin/bash

cd /input

for i in *.mkv; do avconv -i $i -codec copy $i.mp4 -loglevel error; rm $i; done

mv /input/*.mp4 /output

find /output/* -mtime +5 -exec rm {} \;
