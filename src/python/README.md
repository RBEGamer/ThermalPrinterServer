# RPI BASED BARCODE SCANNER FOR THE THERMAL PRINTER SERVER

This script allowes to scan the product with the barcodescanner and simply adds to the buylist.
It uses the outpan api for the product name.



# PARTS

* USB Barcode scanner
* RPI Zero W


# INSTALLATION
* connect usb scanner and check the /dev/ folder for the scanner device. in my case 'hidraw0'
* edit the barcodescanner.py to you server installation
* install python, python-requests, python-json
* chmod +x ./startup.sh
* run startup.sh
