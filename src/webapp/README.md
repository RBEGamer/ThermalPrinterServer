# SOFTWARE SETUP
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

