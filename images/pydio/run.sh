#!/bin/bash

cp -rn /var/www/pydio-clean/data/* /var/www/pydio/data/
chown -R www-data:www-data /var/www/pydio/data
supervisord -c /etc/supervisor/supervisord.conf
