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
