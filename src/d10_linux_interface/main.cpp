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


#define CHAR_ESCAPE_R (char)13;
#define CHAR_ESCAPE_N (char)10;

#define PRINTER_MAX_LINE_CHARS 24

#define _DEBUG

//some func defines
int write_string(int _fd, std::string& _text);



int write_string_no_ref(int _fd, std::string _t){
std::string t = _t;
    write_string(_fd,_t);
}

int write_string(int _fd, std::string& _text) {
    //check for valid file handle
    if (_fd < 0) {
        return -1;
    }
    std::string tmp = "";
    int line_counter = 0;
    int expected_lines = _text.length() / 24;
#ifdef _DEBUG
    std::cout << "expected lines to print :" << expected_lines << std::endl;
#endif
    volatile bool loop_exit = false;
while(!loop_exit){
    //
    if(line_counter > expected_lines){break;}
    tmp = "";
    //copy 24 chars to the new string and print the line in next loop print the next 24 or less
    for (int i = 0; i < PRINTER_MAX_LINE_CHARS; ++i) {
        if ((line_counter*PRINTER_MAX_LINE_CHARS) + i >= _text.length()) {
            loop_exit = true;
            break;
        }
        tmp += _text.at((line_counter*PRINTER_MAX_LINE_CHARS) + i);
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

    int fd = open("/dev/usb/lp0", O_RDWR);
    if (fd < 0) {
    perror("open: ");
    return 1;
}


    write_string_no_ref(fd, "abcdefghijklmnopjrstuvwxyz123456789abcdefghijklmnopjrstuvwxyz");

close(fd);

    return 0;
}