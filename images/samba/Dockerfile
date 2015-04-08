FROM ubuntu:14.10
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  samba \
  supervisor

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 137
EXPOSE 138
EXPOSE 139
EXPOSE 445

CMD ["/usr/bin/supervisord"]
