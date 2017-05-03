//
//  ini_parser.cpp
//  FRM_INI_PARSER
//
//  Created by Marcel Ochsendorf on 05.11.16.
//  Copyright © 2016 Marcel Ochsendorf. All rights reserved.
//

#include "ini_parser.hpp"

FRM::ini_parser::ini_parser(){
    loaded_ini_file = NULL;
    loaded_ini_file = new INI_FILE_DESC();
}


FRM::ini_parser::~ini_parser(){
    delete[] loaded_ini_file->sections;
    delete loaded_ini_file;
    loaded_ini_file = NULL;
}

FRM::ini_parser::INI_FILE_DESC* FRM::ini_parser::get_parsed_info(){
    return loaded_ini_file;
}

/* CHECK PASSED */
std::string* FRM::ini_parser::get_value(const std::string _section,const std::string _key){
    if(loaded_ini_file == nullptr){
        return nullptr;
    }
#if defined(INI_PARSER_USE_STD_MAP)
    return &ini_dict[_section][_key];
#else
    for (int i = 0; i < loaded_ini_file->section_count ; i++) {
        if((loaded_ini_file->sections+i)->section_name == _section){
            for (int j = 0; j < (loaded_ini_file->sections+i)->key_value_count; j++) {
                if(((loaded_ini_file->sections+i)->kvpair+j)->key == _key){
                    return &(((loaded_ini_file->sections+i)->kvpair+j)->value);
                }
            }
        }
    }
    return nullptr;
#endif
}

/* CHECK PASSED */
void FRM::ini_parser::load_ini_string(const char* _string){
    
    if (_string)
    {
        //prepare file content
        std::string file_content = _string;
        file_content.insert(0, INI_PARSER_NEW_LINE_CHARAKTER);
        file_content.append(INI_PARSER_NEW_LINE_CHARAKTER);
        //count lines and sections to allocate the array
        const char* comma_counter_itr = strstr(file_content.c_str(), INI_PARSER_NEW_LINE_CHARAKTER);
        const char* comma_counter_end = NULL;
        std::string line_content = "";
        int comma_array_size = 0;
        int section_counter = 0;
        int kv_counter = 0;
        while (true) {
            comma_counter_itr = strstr(comma_counter_itr, INI_PARSER_NEW_LINE_CHARAKTER);
            if(comma_counter_itr == NULL){break;}
            comma_counter_itr++;
            comma_counter_end = strstr(comma_counter_itr, INI_PARSER_NEW_LINE_CHARAKTER);
            if(comma_counter_end == NULL){break;}
            line_content = "";
            line_content.append(comma_counter_itr,comma_counter_end);
            //comma_counter_end++;
            comma_counter_itr =comma_counter_end;
            if(line_content ==""){continue;}
            if(line_content.at(0) == '['){section_counter++;}
            else if(line_content.at(0) == ';'){comma_array_size++;}
            else{kv_counter++;}
        }
        
        
        //allocate memory for sections
        loaded_ini_file->section_count =section_counter;
        loaded_ini_file->sections = new INI_FILE_SECTION[section_counter]();
        //init sections
        comma_counter_itr = strstr(file_content.c_str(), INI_PARSER_NEW_LINE_CHARAKTER);
        int section_itr_counter = 0;
        INI_FILE_SECTION* curr_section = NULL;
        //load sections
        while (true) {
            comma_counter_itr = strstr(comma_counter_itr, INI_PARSER_NO_CHARAKTER);
            //if(comma_counter_itr == NULL){break;}
            comma_counter_itr++;
            if(comma_counter_itr == NULL){break;}
            comma_counter_end = strstr(comma_counter_itr, INI_PARSER_NEW_LINE_CHARAKTER);
            if(comma_counter_end == NULL){break;}
            line_content = "";
            line_content.append(comma_counter_itr,comma_counter_end);
            //comma_counter_end++;
            comma_counter_itr =comma_counter_end;
            if(line_content ==""){continue;}
            if(line_content.at(0) == '['){
                line_content.erase(0,1);
                line_content.erase(line_content.size()-1);
                (loaded_ini_file->sections+section_itr_counter)->section_name =line_content;
                (loaded_ini_file->sections+section_itr_counter)->key_value_count = 0;
                curr_section = (loaded_ini_file->sections+section_itr_counter);
                section_itr_counter++;
            }else if(line_content.at(0) != ';'){
                curr_section->key_value_count++;
            }else{
                continue;
            }
        }
        
        
        //allocate memory fpr all sections
        for (int i = 0; i < loaded_ini_file->section_count; i++) {
            (loaded_ini_file->sections+i)->kvpair = new INI_FILE_KVPAIR[(loaded_ini_file->sections+i)->key_value_count]();
        }
        
        
        //load all kv pairs
        comma_counter_itr = strstr(file_content.c_str(), INI_PARSER_NEW_LINE_CHARAKTER);
        section_itr_counter = 0;
        curr_section = NULL;
        int kvpair_counter = 0;
        //load sections
        while (true) {
            comma_counter_itr = strstr(comma_counter_itr, INI_PARSER_NEW_LINE_CHARAKTER);
            //if(comma_counter_itr == NULL){break;}
            comma_counter_itr++;
            if(comma_counter_itr == NULL){break;}
            comma_counter_end = strstr(comma_counter_itr, INI_PARSER_NEW_LINE_CHARAKTER);
            if(comma_counter_end == NULL){break;}
            line_content = "";
            line_content.append(comma_counter_itr,comma_counter_end);
            //comma_counter_end++;
            comma_counter_itr =comma_counter_end;
            if(line_content ==""){continue;}
            if(line_content.at(0) == '['){
                line_content.erase(0,1);
                line_content.erase(line_content.size()-1);
                
                for (int i = 0; i < loaded_ini_file->section_count; i++) {
                    if((loaded_ini_file->sections+i)->section_name == line_content){
                        curr_section = (loaded_ini_file->sections+i);
                        kvpair_counter =0;
                    }
                }
                
                
                
                section_itr_counter++;
            }else if(line_content.at(0) == ';'){
            }else{
                //conten = kv pair und das parsen und speichern
                if(curr_section == NULL){continue;}
                
                const char* kstart = strstr(line_content.c_str(), INI_PARSER_NO_CHARAKTER);
                if(kstart == NULL){continue;}
                const char* kend =  strstr(kstart, INI_PARSER_EQUAL_CHARAKTER);
                if(kend == NULL){continue;}
                std::string key_content = "";
                key_content.append(kstart, kend);
                
                (curr_section->kvpair+kvpair_counter)->key = key_content;
                (curr_section->kvpair+kvpair_counter)->value = "";
                
                // const char* vend = strstr, "\n");
                
                std::string value_content = "";
                value_content.append(++kend);
                (curr_section->kvpair+kvpair_counter)->value = value_content;
                kvpair_counter++;
            }
        }
        
        
#if defined(INI_PARSER_USE_STD_MAP)
        for (int i = 0; i < loaded_ini_file->section_count ; i++) {
            for (int j = 0; j < (loaded_ini_file->sections+i)->key_value_count; j++) {
                ini_dict[(loaded_ini_file->sections+i)->section_name][((loaded_ini_file->sections+i)->kvpair+j)->key] = ((loaded_ini_file->sections+i)->kvpair+j)->value;
            }
        }
        
        //delete loaded_ini_file->sections;
        //loaded_ini_file->sections = nullptr;
        //delete loaded_ini_file;
        //loaded_ini_file = nullptr;
#endif
        
        
    }else{
        
    }
    
}



/* CHECK PASSED */
void FRM::ini_parser::load_ini_file(const char* _filepath){
    if(_filepath == nullptr){
        return;
    }
    //READ COMPLETE FILE TO BUFFER
    char * complete_content_buffer = 0;
    long length;
    FILE * file_handler = fopen (_filepath, "rt");
    
    if (file_handler)
    {
        fseek (file_handler, 0, SEEK_END); //end to get filelenght
        length = ftell (file_handler);
        fseek (file_handler, 0, SEEK_SET);
        complete_content_buffer = (char*)malloc (length);
        if (complete_content_buffer)
        {
            fread (complete_content_buffer, 1, length, file_handler);
        }
        fclose (file_handler);
    }else{
        return;
    }
    
    if(complete_content_buffer){
        load_ini_string(complete_content_buffer);
        free(complete_content_buffer);
    }else{
        return;
    }
    
    
    
}

