#!/usr/bin/bash bash
WORKINGDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
SOURCEDIR="$(dirname $WORKINGDIR)"
SYSTEMDIR="/etc/systemd/system"
OPTDIR="/opt/messagebroker"
FILESERVICE="$OPTDIR/bin/messagebroker.service"
FILESYSTEM="$SYSTEMDIR/messagebroker.service"
sudo mkdir -p $OPTDIR
sudo cp -R $SOURCEDIR/* $OPTDIR
sudo ln -s $FILESERVICE $FILESYSTEM
sudo systemctl enable messagebroker.service
sudo systemctl start messagebroker.service
systemctl status messagebroker.service
