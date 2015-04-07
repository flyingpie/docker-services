FROM dockerfile/supervisor
MAINTAINER Marco vd Oever <marco@flyingpie.nl>

ENV PYDIO_VERSION 6.0.5

# ------------------------------------------------------------------------------
# Install Base
RUN apt-get update
RUN apt-get install -yq \
  fontconfig-config \
  fonts-dejavu-core \
  libgd-tools \
  libmcrypt-dev \
  mcrypt \
  nano \
  nginx \
  php-pear \
  php5-cli \
  php5-common \
  php5-fpm \
  php5-gd \
  php5-json \
  php5-mcrypt \
  php5-mysql \
  php5-readline \
  psmisc \
  sendmail \
  ssl-cert \
  ufw \
  unzip \
  wget

# ------------------------------------------------------------------------------
# Configure php-fpm
RUN sed -i -e "s/output_buffering\s*=\s*4096/output_buffering = Off/g" /etc/php5/fpm/php.ini
RUN sed -i -e "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g" /etc/php5/fpm/php.ini
RUN sed -i -e "s/upload_max_filesize\s*=\s*2M/upload_max_filesize = 1G/g" /etc/php5/fpm/php.ini
RUN sed -i -e "s/post_max_size\s*=\s*8M/post_max_size=1G/g" /etc/php5/fpm/php.ini

RUN sed -i -e "s/pm.max_children\s*=\s*5/pm.max_children = 10/g" /etc/php5/fpm/pool.d/www.conf

RUN php5enmod mcrypt 

# ------------------------------------------------------------------------------
# Configure nginx
RUN mkdir /var/www
RUN chown www-data:www-data /var/www
RUN rm /etc/nginx/sites-enabled/*
RUN rm /etc/nginx/sites-available/*
RUN sed -i -e"s/keepalive_timeout\s*65/keepalive_timeout 20;\n\tclient_max_body_size 1G/" /etc/nginx/nginx.conf
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
ADD conf/pydio /etc/nginx/sites-enabled/

# ------------------------------------------------------------------------------
# Configure services
RUN update-rc.d nginx defaults
RUN update-rc.d php5-fpm defaults

# ------------------------------------------------------------------------------
# Install Pydio
WORKDIR /var/www
RUN wget "http://sourceforge.net/projects/ajaxplorer/files/pydio/stable-channel/${PYDIO_VERSION}/pydio-core-${PYDIO_VERSION}.zip"
RUN unzip pydio-core-${PYDIO_VERSION}.zip && mv /var/www/pydio-core-${PYDIO_VERSION} /var/www/pydio && rm -rf /var/www/pydio-core-*
RUN cp -r /var/www/pydio /var/www/pydio-clean
RUN chown -R www-data:www-data /var/www/pydio
RUN chown -R www-data:www-data /tmp
RUN chmod -R 770 /var/www/pydio

WORKDIR /

# ------------------------------------------------------------------------------
# Expose ports
EXPOSE 80
EXPOSE 443

# two additional ports to use with WS server
EXPOSE 18081
EXPOSE 10801

# ------------------------------------------------------------------------------
# Expose volumes
VOLUME /var/www/pydio/data/

# ------------------------------------------------------------------------------
# Add supervisord conf
ADD conf/startup.conf /etc/supervisor/conf.d/
ADD ./run.sh /run.sh

# Start supervisor, define default command.
CMD ["sh", "/run.sh"]
