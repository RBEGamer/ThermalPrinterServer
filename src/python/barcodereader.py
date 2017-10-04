import sys
import os
import signal
import requests
import json
import re
import csv


printer_server = "http://" + XXXXXXXXX +"/einkaufslistendrucker/add_bc_item.php"

hid = {4: 'a', 5: 'b', 6: 'c', 7: 'd', 8: 'e', 9: 'f', 10: 'g', 11: 'h', 12: 'i', 13: 'j', 14: 'k', 15: 'l', 16: 'm',
       17: 'n', 18: 'o', 19: 'p', 20: 'q', 21: 'r', 22: 's', 23: 't', 24: 'u', 25: 'v', 26: 'w', 27: 'x', 28: 'y',
       29: 'z', 30: '1', 31: '2', 32: '3', 33: '4', 34: '5', 35: '6', 36: '7', 37: '8', 38: '9', 39: '0', 44: ' ',
       45: '-', 46: '=', 47: '[', 48: ']', 49: '\\', 51: ';', 52: '\'', 53: '~', 54: ',', 55: '.', 56: '/'}
hid2 = {4: 'A', 5: 'B', 6: 'C', 7: 'D', 8: 'E', 9: 'F', 10: 'G', 11: 'H', 12: 'I', 13: 'J', 14: 'K', 15: 'L', 16: 'M',
        17: 'N', 18: 'O', 19: 'P', 20: 'Q', 21: 'R', 22: 'S', 23: 'T', 24: 'U', 25: 'V', 26: 'W', 27: 'X', 28: 'Y',
        29: 'Z', 30: '!', 31: '@', 32: '#', 33: '$', 34: '%', 35: '^', 36: '&', 37: '*', 38: '(', 39: ')', 44: ' ',
        45: '_', 46: '+', 47: '{', 48: '}', 49: '|', 51: ':', 52: '"', 53: '~', 54: '<', 55: '>', 56: '?'}

fp = open('/dev/hidraw0', 'rb')

read_barcode = ""
shift = False


def clean_up(signal, frame):
    print "Ctrl+C captured, ending read."
    fp.close();



# Hook the SIGINT
signal.signal(signal.SIGINT, clean_up)

def add_to_db(item_text, failed):
    r = requests.get(printer_server + "?item" + item_text + "&barscanid=" + "1337" + "&prodfound=" + failed)
    if r.status_code == 200:
        if  r.text == "ok":
            print "insert_ok"
    else:
        # no prod found add to database simply add the ean as item name to check later
        print "service not reacable"
    return


def do_sth_with_barcode(bcdata):
    r = requests.get("https://api.outpan.com/v2/products/" + bcdata + "?apikey=" + API_KEY)
    if r.status_code == 200:
        #print r.text
        #if r.headers['content-type'].find("json") != -1:
        if re.search("json", r.headers['content-type']):
            parsed_json = json.loads(r.text)
            if not parsed_json['name'] == '':
                print parsed_json['name']
                add_to_db(parsed_json['name'],1)
        else:
            #no jason response
            print 'read_barcode_data NOT FOUND IN DATABASE: ' + bcdata
            add_to_db(bcdata,0)
    else:
        #no prod found add to database simply add the ean as item name to check later
        add_to_db(bcdata,0)
    return


while 42:
    buffer = fp.read(8)
    for c in buffer:
        if ord(c) > 0:
            if int(ord(c)) == 40: #40 = Carrage return code
                do_sth_with_barcode(read_barcode)
                print 'scan next barcode'
                read_barcode = ''
                continue
            if shift:
                if int(ord(c)) == 2:
                    shift = True
                else:
                    read_barcode += hid2[int(ord(c))]
                    shift = False
            else:
                if int(ord(c)) == 2:
                    shift = True
                else:
                    read_barcode += hid[int(ord(c))]

