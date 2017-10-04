# Thermal Print Server

# FEATURES
* I. collect your items on the website
* II.print them out
* III. forget nothing
* multible printers are supported
* simple configuration
* NOW! WITH ALEXA SKILL SET
* NOW!! WITH RPI BARCODE SCANNER

# PARTS
* D10 ASCII thermal printer
* USB->Parallel Adapter
* RPI
* SD CARD
* 9V/1A Power supply for the printer
* 5V Regulator for the pi
* Thermal paper 57mm width

# HARDWARE SETUP
* connect printer and pi with the usb->parallel adapter
* connect the 5v with the 9v supply and 5v and gnd of the pi
* insert the sd card with raspian
* load paper to the printer

# SOFTWARE SETUP (RUN ALL AS SUDO)
## INSTALL APACHE2
* apt-get update
* apt-get upgrade 
* apt-get install mysql-server -y (PLEASE DONT USE ROOT OR SO...)
* apt-get install apache2 -y
* apt-get install php5 libapache2-mod-php5 php5-mysql php5-mcrypt -y
## INSTALL PHPMYADMIN
* apt-get install phpmyadmin -y
* nano /etc/apache2/apache2.conf
* paste `Include /etc/phpmyadmin/apache.conf` to the end of the file
## REBOOT
* reboot
## INSTALL BUILD ENVIRONMENT
* apt-get install git-all -y
* apt-get install curl libcurl4-openssl-dev -y
* apt-get -y install build-essential
## REBOOT
* reboot
## CLONE SOURCES
* cd /home/USER_HERE/
* git clone https://github.com/RBEGamer/ThermalPrinterServer.git
## COMPILE SOURCES
* cd ./ThermalPrinterServer/src/d10_linux_interface/
* g++ main.cpp ini_parser.cpp ini_parser.hpp HTTPDownloader.cpp HTTPDownloader.hpp -std=c++11 -L/usr/lib/arm-linux-gnueabihf -lcurl -o d10_printer_server.o
## COPY EXEFILES
* chmod +x d10_printer_server.o
* mkdir /home/USER_HERE/print_server/
* cp ./d10_printer_server.o /home/USER_HERE/print_server
## COPY CONFIG FILES TO EXE DIR
* cp /home/USER_HERE/ThermalPrinterServer-master/src/conf.ini /home/pi/print_server/
## COPY php files to WWW
* cp -R /home/USER_HERE/ThermalPrinterServer-master/src/webapp /var/www/html
## EDIT rc.local for autostart
* nano /etc/rc.local
* and write before `exit0;` `/home/USER_HERE/print_server/d10_printer_server.o &`
# PRINTER CONNECTION
* connect the printer to a usb port of the pi
* check the lp port number by run `ls /dev/usb/`
* edit the entry `printer_device_file` in the `/home/USER_HERE/printer_server/config.ini`
#  LOAD SQL TABLE
* open phpmyadmin and import the `/src/buyprinter.sql` to create all needed databases
* to add a printer, add the `printers` table
# EDIT PHP FILES
* open the `db_conf.php` and change set variables to your mysql server settings
# FINISH
* open your browser to `http://IP_HERE/webapp/index.php`



# ALEXA SETUP
* your server must have a dynamic ip or you have to use a dyndns or RB_DNS
* signin/register for the amazon aws and alexa skill set service
* create a new alexa skill and setup the files
* create icons
* enable the beta service and enale it on your echo
* create a aws lambda function and the the trigger function to echo skill (eu server)
* setup in the index.js your server ip
* upload the requests package

# IMAGES

## SIMPLE WEBINTERFACE
![Gopher image](/documentation/webapp.PNG)

## PRINTED BUYLIST
![Gopher image](/documentation/output_print.jpg)
