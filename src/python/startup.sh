#!/bin/bash

echo "setup barcode scanner file permission"
sudo chmod 774 /dev/hidraw0

sudo python ~/barcodereader.py &

