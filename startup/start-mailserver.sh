#!/bin/bash

source variables.sh

docker rm -f mailserver

docker run --name mailserver -d \
  -p 25:25 \
  -p 587:587 \
  -p 143:143 \
  -p 993:993 \
  -v /var/docker/mailserver/settings:/mail_settings \
  -v /var/docker/mailserver/vmail:/vmail \
  -v /var/docker/proxy/certs/cloud.flyingpie.nl.crt:/etc/dovecot/dovecot.pem:ro \
  -v /var/docker/proxy/certs/cloud.flyingpie.nl.key:/etc/dovecot/private/dovecot.pem:ro \
  dockermail_made_special
