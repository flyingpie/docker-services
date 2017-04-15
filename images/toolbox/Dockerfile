FROM ubuntu:latest
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update

# Docker
RUN DEBIAN_FRONTEND=noninteractive apt-get install -y \
  apt-transport-https \
  ca-certificates \
  curl \
  software-properties-common

RUN curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

RUN DEBIAN_FRONTEND=noninteractive add-apt-repository \
  "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) \
  stable"

# Apps
RUN DEBIAN_FRONTEND=noninteractive apt-get update && apt-get install -y \
  docker-ce \
  fish \
  toilet toilet-fonts \
  vim

# Config
ADD image/root /root

# Scripts
RUN chmod +x /root/bin/*

# Startup
ADD image/toolbox.sh /toolbox.sh
RUN chmod +x /toolbox.sh

RUN echo "Build: $(date) @ $HOSTNAME" >> /build-info.txt

WORKDIR "/root"
ENTRYPOINT ["/toolbox.sh"]
