Pydio Dockerfile
=============

# Base Docker Image
[dockerfile/supervisor](https://registry.hub.docker.com/u/dockerfile/supervisor/)

# Installation

## Install Docker.

Download automated build from public Docker Hub Registry: docker pull mkodockx/docker-pydio

## Usage

    docker run -d -p 80:80 mkodockx/docker-pydio
    
You should add a shared directory as a volume directory with the arguments *-v /your-path/files/:/var/www/pydio/data/files/ -v /var/www/pydio/data/personal/:/pydio-data/personal/* like this :

    docker run -it -d -p 80:80 -v /your-path/files/:/var/www/pydio/data/files/ -v /var/www/pydio/data/personal/:/pydio-data/personal/ mkodockx/docker-pydio

*Ensure your host paths are accessible for the image e.g. by setting a 0777 to them on the host.*

A mysql server with a database is ready, you can use it with this parameters : 

  - url : localhost
  - database name : pydiodb
  - user name : pydiomgr
  - user password : wH00pDaRoot
  
## Environment variables

    -e PYDIO_VERSION=6.0.3
    -e DB_NAME=yourdbname
    -e DB_USER=yourusername
    -e DB_PASS=yoursecret