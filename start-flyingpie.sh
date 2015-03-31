docker rm -f flyingpie-cmsms

docker run --name flyingpie-cmsms -d \
  -e MYSQL_HOST=mysql \
  -e MYSQL_USER=cmsms \
  -e MYSQL_PASS=sqAVm6HqXWjnKExb \
  -e MYSQL_DB=cmsms \
  -e VIRTUAL_HOST=flyingpie.local \
  --link mysql:mysql \
  -p 80 \
  flyingpie/flyingpie-cmsms
