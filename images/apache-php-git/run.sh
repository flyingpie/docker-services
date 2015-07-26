rm /var/www/html
ln -s /app/${ROOT_FOLDER} /var/www/html

supervisord
