FROM tutum/apache-php
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

ENV USERNAME $USERNAME
ENV PASSWORD $PASSWORD

RUN apt-get update && apt-get install -y \
  apache2-utils

ADD ./apache2.conf /apache2.conf
ADD ./app /app
ADD ./protect-and-run.sh /protect-and-run.sh

RUN cat /apache2.conf >> /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80

WORKDIR /

CMD ["/protect-and-run.sh"]
