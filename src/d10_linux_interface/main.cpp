#define AUTHOR "Marcel Ochsendorf"
#define MAIL "marcel.ochsendorf@gmail.com"
#define GITHUB "github.com/RBEGamer"

#define VERSION "0.9"
#define PROGRAM_NAME "SIMPLE D10 THERMAL PRINTER SERVER"


#include <iostream>
#include <stdio.h>
#include <fcntl.h>
#include <sys/ioctl.h>
#include <unistd.h>
#include <string.h>
#include <signal.h>


//3rd libs
#include "ini_parser.hpp" //github.com/RBEGamer/Ini-Parser

#define INI_CONF_FILE_PATH "./conf.ini"
//PRINTER SETTINGS
#define CHAR_ESCAPE_R (char)13; //or '\r'
#define CHAR_ESCAPE_N (char)10; // or '\n'

#define PRINTER_MAX_LINE_CHARS 24
#define PRINTER_DEVICE_FILE "/dev/usb/lp0"
#define _DEBUG

//some func defines
int write_string(int _fd, std::string& _text, int _len);

//VARS
int fd_printer = -1;
int printer_line_char_width = PRINTER_MAX_LINE_CHARS;


//SIGNAL HANDLING
void signalHandler(int signum) {
    //close printer handle
    if(fd_printer >= 0){
        close(fd_printer);
    }
    std::cout << "Interrupt signal (" << signum << ") received.\n";
    exit(signum);
}
int write_string_no_ref(int _fd, std::string _t, int _len){
std::string t = _t;
    write_string(_fd,_t, _len);
}

int write_string(int _fd, std::string& _text, int _line_width = PRINTER_MAX_LINE_CHARS) {
    //check for valid file handle
    if (_fd < 0) {
        return -1;
    }
    if(_line_width <= 0){
        return -3;
    }
    std::string tmp = "";
    int line_counter = 0;
    int expected_lines = _text.length() / _line_width;
#ifdef _DEBUG
    std::cout << "expected lines to print :" << expected_lines << std::endl;
#endif
    volatile bool loop_exit = false;
while(!loop_exit){
    //
    if(line_counter > expected_lines){break;}
    tmp = "";
    //copy 24 chars to the new string and print the line in next loop print the next 24 or less
    for (int i = 0; i < _line_width; ++i) {
        if ((line_counter*_line_width) + i >= _text.length()) {
            loop_exit = true;
            break;
        }
        tmp += _text.at((line_counter*_line_width) + i);
    }
    line_counter++;
    //final send string to printer
    #ifdef _DEBUG
    std::cout << "PRINT LINE " << line_counter << " : " << tmp << std::endl;
    #else
    //printer needs a rn for a end line
    tmp += CHAR_ESCAPE_R;
    tmp += CHAR_ESCAPE_N;
    if (write(_fd, tmp.c_str(), tmp.length()) < 0) {
        return -2;
    }
#endif


}
    return 0;
}



int main() {
    //register signal handler
    signal(SIGINT, signalHandler);

    //load config file
    FRM::ini_parser* conf_parser = new FRM::ini_parser();
   conf_parser->load_ini_file(INI_CONF_FILE_PATH);
    //load printer conf and try to open the printer device file
    std::string conf_csv = *conf_parser->get_value("path", "printer_device_file");
    if (conf_csv == "") {
        //set default value
        conf_csv = PRINTER_DEVICE_FILE;
        std::cout << "INI key=printer_device_file not found use default" <<std::endl;
    }
     fd_printer = open(conf_csv.c_str(), O_RDWR);
    if (fd_printer < 0) {
    perror("open: ");
    return 1;
}

     conf_csv = *conf_parser->get_value("path", "printer_line_width_chars");
    if (conf_csv == "") {
        //set default value
        printer_line_char_width = PRINTER_MAX_LINE_CHARS;
        std::cout << "INI key=printer_line_width_chars not found use default" <<std::endl;
    }else{
        printer_line_char_width = atoi(conf_csv.c_str());
    }



    //so the opening is success so we can start the http deamon

    write_string_no_ref(fd_printer, "abcdefghijklmnopjrstuvwxyz123456789abcdefghijklmnopjrstuvwxyz", printer_line_char_width);

    //close printer handle
    if(fd_printer >= 0){
        close(fd_printer);
    }

    return 0;
}