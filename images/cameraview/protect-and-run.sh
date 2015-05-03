#!/bin/bash

htpasswd -cb /htpasswd $USERNAME $PASSWORD

./run.sh
