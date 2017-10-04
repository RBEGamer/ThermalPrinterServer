#!/bin/bash

echo "setup barcode scanner file permission"
chmod 774 /dev/hidraw0

python ~/barcodereader.py

