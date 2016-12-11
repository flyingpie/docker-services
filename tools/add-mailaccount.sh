#!/bin/bash

docker run --rm \
  -e MAIL_USER=marco@madstats.nl \
  -e MAIL_PASS=mypassword1 \
  -ti tvial/docker-mailserver:latest \
  /bin/sh -c 'echo "$MAIL_USER|$(doveadm pw -s SHA512-CRYPT -u $MAIL_USER -p $MAIL_PASS)"' >> /var/docker/mailserver/config/postfix-accounts.cf
