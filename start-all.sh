#!/bin/bash

# Utility
./start-dockerui.sh
./start-rsnapshot.sh

# Databases
./start-mysql.sh
./start-postgresql.sh
./start-redis.sh

# Applications
./start-fileserver.sh
./start-flyingpie.sh
./start-gitlab.sh
./start-owncloud.sh
./start-phpmyadmin.sh
./start-phppgadmin.sh

# Proxy
./start-proxy.sh
