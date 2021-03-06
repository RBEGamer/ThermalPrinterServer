#define AUTHOR "Marcel Ochsendorf"
#define MAIL "marcel.ochsendorf@gmail.com"
#define GITHUB "github.com/RBEGamer"

#define VERSION "1.0"
#define PROGRAM_NAME "SIMPLE D10 THERMAL PRINTER SERVER"

//#define _DEBUG
#include <iostream>
#include <stdio.h>
#include <fcntl.h>
#include <sys/ioctl.h>
#include <unistd.h>
#include <string>

#include <signal.h>
#include <curl/curl.h>


#include <ctime>
#include <sstream>

//3rd libs
//INI PARSER LIB
#include "ini_parser.hpp" //github.com/RBEGamer/Ini-Parser
#define INI_CONF_FILE_PATH "./conf.ini"

#include "HTTPDownloader.hpp"



//PRINTER SETTINGS
#define CHAR_ESCAPE_R (char)13; //or '\r'
#define CHAR_ESCAPE_N (char)10; // or '\n'

//HERE YOU CAN SET THE DEFAULT PARAMETER IF THE CONFIG FILE NOT EXISTS
#define PRINTER_MAX_LINE_CHARS 24
#define PRINTER_DEVICE_FILE "/dev/usb/lp0"
#define HTTP_REQUEST_URL "http://127.0.0.1/get_print_lines.php?printer_id=1"
#define REQ_UPDATE_INTERVAL_MS 5000

#define REQ_CONTENT_NEW_LINE_SEPERATOR '\n'
//#define _DEBUG


//some func defines
int write_string(int _fd, std::string& _text, int _len);

//VARS
int fd_printer = -1;
int printer_line_char_width = PRINTER_MAX_LINE_CHARS;
std::string request_url_for_text = HTTP_REQUEST_URL;
long req_update_interval_ms = REQ_UPDATE_INTERVAL_MS;
std::string request_content_save = ""; //to compare and print only if other versions
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
#ifndef _DEBUG
    if (_fd < 0) {
        return -1;
    }
#endif
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
#ifdef _DEBUG
std::cout << "_DEBUG WAS DEFINED SO ALL PRINT COMMANDS WILL ONLY SHOWN IN THE CONSOLE" << std::endl;
    #endif
    
    std::cout << "PLEASE MAKE SURE THEconf.ini file is in the same directory as this executable" << std::endl;
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
#ifndef _DEBUG
     fd_printer = open(conf_csv.c_str(), O_RDWR);
    if (fd_printer < 0) {
    perror("open: ");
    return 1;
}
#endif

    //LOAD CONFIG CHARS WIDTH
     conf_csv = *conf_parser->get_value("path", "printer_line_width_chars");
    if (conf_csv == "") {
        //set default value
        printer_line_char_width = PRINTER_MAX_LINE_CHARS;
        std::cout << "INI key=printer_line_width_chars not found use default:"<< PRINTER_MAX_LINE_CHARS <<std::endl;
    }else{
        printer_line_char_width = atoi(conf_csv.c_str());
    }
//LOAD CONFIG REQ URL
    conf_csv = *conf_parser->get_value("url", "get_text_request_url");
    if (conf_csv == "") {
        //set default value
        request_url_for_text = HTTP_REQUEST_URL;
        std::cout << "INI key=get_text_request_url not found use default:" << HTTP_REQUEST_URL  <<std::endl;
    }else{
        request_url_for_text = conf_csv;
    }

write_string_no_ref(fd_printer, request_url_for_text, printer_line_char_width);

write_string_no_ref(fd_printer, "--- ITEM LIST ---", printer_line_char_width);
    
    
    //LOAD CONFIG UPDATE INTERVAL
    conf_csv = *conf_parser->get_value("url", "refresh_interval_ms");
    if (conf_csv == "") {
        //set default value
        req_update_interval_ms = REQ_UPDATE_INTERVAL_MS;
        std::cout << "INI key=printer_line_width_chars not found use default:"<<REQ_UPDATE_INTERVAL_MS <<std::endl;
    }else{
        req_update_interval_ms = atol(conf_csv.c_str());
    }


    clock_t start = clock();
    request_content_save = "";
//ENTER MAIN LOOP
volatile bool exit_main_loop = false;
    std::string single_line = "";
    std::cout << "starting main loop" << std::endl;
    while (!exit_main_loop){
        clock_t end = clock();
        //if end - start > delay time fire the print progress
        if((end - start)/1000 > req_update_interval_ms){
            start = clock(); //save new start clock for next turn
            //MAKE A REQUEST
            HTTPDownloader downloader;
            std::string content = downloader.download(request_url_for_text);
            if(!content.empty()) {
                if (request_content_save != content) {
                    request_content_save = content;
                //TODO ADD SPLIT BY NEW LINE AND <br>
                    std::stringstream ss(content);
                    //split by char
                    while(std::getline(ss,single_line,REQ_CONTENT_NEW_LINE_SEPERATOR)){

                        write_string_no_ref(fd_printer, single_line, printer_line_char_width);
                    }

                }
            }
        }
    }




//CLEANUP STUFF

    //close printer handle
    if(fd_printer >= 0){
        close(fd_printer);
    }

    return 0;
}
