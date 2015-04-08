FROM ruby:2.1
MAINTAINER Marco vd Oever <marco@flyingpie.nl>

RUN apt-get update \
  && apt-get install -y \
    node \
    node-less \
    python-pygments \
  && apt-get clean

RUN gem install \
  github-pages \
  jekyll \
  jekyll-redirect-from \
  kramdown \
  rdiscount \
  rouge

ADD src /src

VOLUME /src
EXPOSE 4000

WORKDIR /src

ENTRYPOINT ["jekyll"]
