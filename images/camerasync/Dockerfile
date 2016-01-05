FROM hamiltont/docker-cron
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  libav-tools \
  ncftp

RUN mkdir -p /var/log/supervisor

COPY sync.sh /sync.sh
RUN chmod +x /sync.sh

COPY crontab /cron/crontab

VOLUME /output
