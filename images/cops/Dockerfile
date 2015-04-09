FROM tutum/apache-php
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN apt-get update && apt-get install -y \
  git \
  php5-sqlite \
  php5-intl

RUN rm -r /app/*
RUN git clone https://github.com/seblucas/cops.git /app/

ADD config_local.php /app/config_local.php

RUN a2enmod rewrite
