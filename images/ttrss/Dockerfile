FROM clue/ttrss
MAINTAINER Marco van den Oever <marco@flyingpie.nl>

RUN git clone https://github.com/naeramarth7/clean-greader /var/www/themes/clean-greader
RUN ln -s /var/www/themes/clean-greader/clean-greader.css /var/www/themes/clean-greader.css

RUN git clone https://github.com/levito/tt-rss-feedly-theme.git /var/www/themes/feedly-theme/
RUN cp -r /var/www/themes/feedly-theme/* /var/www/themes/
