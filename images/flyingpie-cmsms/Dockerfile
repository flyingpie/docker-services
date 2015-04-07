FROM tutum/apache-php
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

ENV MYSQL_HOST mysql
ENV MYSQL_USER user
ENV MYSQL_PASS pass
ENV MYSQL_DB db

COPY ./web /app
COPY ./web/config.php /app/config.php

CMD ["/run.sh"]
