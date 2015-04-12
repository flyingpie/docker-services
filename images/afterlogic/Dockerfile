FROM tutum/apache-php
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  wget \
  unzip

#RUN rm -r /app/*

RUN wget http://www.afterlogic.org/download/webmail_php.zip

RUN mkdir /webmail
RUN unzip webmail_php.zip -d /app/

#RUN mv /webmail/webmail/* /app/
