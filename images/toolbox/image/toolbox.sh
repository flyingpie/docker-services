#!/bin/bash

cd /$HOSTNAME

clear

echo ""
toilet "  crashlog  " -f pagga.tlf --filter border --filter gay
toilet -f wideterm.tlf " crashlog's  toolbox"
echo ""

cat /build-info.txt
echo ""

fish
