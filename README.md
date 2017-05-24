# Thermal Print Server

# FEATURES

# PARTS

* D10 ASCII thermal printer
* USB->Parallel Adapter
* RPI
* SD CARD
* 9V Power supply for the printer
* 5V Regulator

# HARDWARE SETUP


# SOFTWARE SETUP (RUN ALL AS SUDO)
## INSTALL APACHE2
* apt-get update
* apt-get upgrade 
* apt-get install mysql-server -y
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
* apt-get install curl libcurl4-openssl-dev
* apt-get -y install build-essential
## REBOOT
* reboot
## CLONE SOURCES
* cd /home/pi/
* git clone https://github.com/RBEGamer/ThermalPrinterServer.git

## COMPILE SOURCES
* cd ./ThermalPrinterServer/src/d10_linux_interface/
* g++ main.cpp ini_parser.cpp ini_parser.hpp HTTPDownloader.cpp HTTPDownloader.hpp -std=c++11 -L/usr/lib/arm-linux-gnueabihf -lcurl -o d10_printer_server.o

## COPY EXEFILES
* chmod +x d10_printer_server.o
* mkdir /home/pi/print_server/
* cp ./d10_printer_server.o /home/pi/print_server
## COPY CONFIG FILES TO EXE DIR
* cp /home/pi/ThermalPrinterServer-master/src/conf.ini /home/pi/print_server/

## COPY php files to WWW
* cp -R /home/pi/ThermalPrinterServer-master/sry/webapp /var/www/html

## EDIT rc.local for autostart
* nano /etc/rc.local
* and write before exit0_ `/home/pi/print_server/d10_printer_server.o &`

# PRINTER CONNECTION
* connect the printer to a usb port of the pi
* check the lp port by run `ls /dev/usb/`
* edit the entry `printer_device_file` int the `/home/pi/printer_server/config.ini`

#  LOAD SQL TABLE
* open phpmyadmin and import the `/src/buyprinter.sql` to create all needed databases
# EDIT PHP FILES
* open the `db_conf.php` and change set variables to your mysql server settings






# IMAGES

## SIMPLE WEBINTERFACE
![Gopher image](/documentation/IMAGES/webapp.PNG)

## PRINTED BUYLIST
![Gopher image](/documentation/IMAGES/output_print.jpg)
