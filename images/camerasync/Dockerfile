FROM ubuntu:14.04
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  libav-tools \
  ncftp

ADD ./sync.sh /sync.sh
RUN chmod +x /sync.sh

ADD ./crontab /crontab
RUN crontab crontab

VOLUME /output
VOLUME /login.cfg

CMD rsyslogd && cron && tail -f /var/log/syslog /var/log/cron.log
