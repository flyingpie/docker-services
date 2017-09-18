FROM hamiltont/docker-cron
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  curl \
  libav-tools \
  ncftp

ENV DOCKER_CHANNEL stable
ENV DOCKER_VERSION 17.03.0-ce

RUN set -ex \
  && curl -fL "https://download.docker.com/linux/static/${DOCKER_CHANNEL}/`uname -m`/docker-${DOCKER_VERSION}.tgz" -o docker.tgz \
  && tar --extract --file docker.tgz --strip-components 1 --directory /usr/local/bin \
  && rm docker.tgz \
  && docker -v

RUN mkdir -p /var/log/supervisor

COPY crontab /cron/crontab
