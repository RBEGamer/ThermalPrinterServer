//
//  ini_parser.hpp
//
//
//  Created by Marcel Ochsendorf on 03.04.16.
//  Copyright © 2016 Marcel Ochsendorf. All rights reserved.
//

#ifndef ini_parser_hpp
#define ini_parser_hpp



/* CLASS DEFINES */
//for more kv request you can use a std::map for faster sections access
#define INI_PARSER_USE_STD_MAP

//DEFINES CHARAKTERS
#define INI_PARSER_EQUAL_CHARAKTER "="
#define INI_PARSER_NO_CHARAKTER ""
//WINDOWS NEEDS AN OTHER LINEENDING
#if defined(_WIN32) || defined(_WIN64) || defined(__WIN__) || defined(FRM_WIN)
#define INI_PARSER_NEW_LINE_CHARAKTER "\r\n"
#else
#define INI_PARSER_NEW_LINE_CHARAKTER "\n"
#endif



#include <stdio.h>
#include <cstring>
#include <iostream>
#include <stdlib.h>

#if defined(INI_PARSER_USE_STD_MAP)
#include <unordered_map>
#endif

namespace FRM {
    
    class ini_parser{
        
    public:
        
        /* STRUCTS */
        struct INI_FILE_KVPAIR{
            std::string key;
            std::string value;
        };
        
        struct INI_FILE_SECTION{
            std::string section_name;
            int key_value_count;
            INI_FILE_KVPAIR* kvpair;
        };
        
        struct INI_FILE_DESC{
            int section_count;
            INI_FILE_SECTION* sections;
        };
        
        /*  FUNCTIONS */
        ini_parser();
        ~ini_parser();
        void load_ini_file(const char* _filepath);
        void load_ini_string(const char* _string);
        std::string* get_value(const std::string _section,const std::string _key);
        INI_FILE_DESC* get_parsed_info();
        
        
    private:
        INI_FILE_DESC* loaded_ini_file;
        
#if defined(INI_PARSER_USE_STD_MAP)
        std::unordered_map<std::string, std::unordered_map<std::string, std::string> > ini_dict;
#endif
        
    };
}



#endif /* tmx_ini_parser_hpp */
