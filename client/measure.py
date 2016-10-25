# Client-side Raspberry Pi Code
# Obtains sensor and device data + sends to server via POST.

# Nathan Catania
# For Team inBin. Telstra University Challenge 2016
# s3477902@student.rmit.edu.au, RMIT University

# v0.8.1
# Last updated: 09/10/16
# Changelog is at bottom of file.

import RPi.GPIO as GPIO
import time
import requests
from subprocess import check_output

#### Bin DEPTH ####
# [LARGE] 240 L Capacity
# Define DEPTH in mm (millimeters):
capacity = 665.0

#### Trigger Level ####
# Fill level of bin that triggers need to empty
# As a percentage, eg: 60%, 75%, 80% etc...
limit = 0.75

#### Authentication and ID ####
# This is sent with Server payload.
# Server will check string. If it does not match this exactly
# then sent data will be discarded.
# This is a quick/dirty way to prevent unauthorised POST data
key = "xNdp9LbK9PSUTYRFDWk2Jr"
deviceID = "EnGenius,0001"

#### Bin Co-Ordinates ####
# Used for Google Maps API
# must be separated by comma
# -37.809379, 144.963595
latitude = -37.918961
longitude = 145.239983

#TODO:
# * Catch and generate timeout/retry for post
# * Generate unique device IDs
# * prefix device ID with name of device (stored in system?)

# ERROR CODES
# Error -2 == Issue with obtaining IP address.

# Setup GPIO and Configure I/O
def setup():
    #### setup GPIO Pins ####
    GPIO.setwarnings(false)
    GPIO.cleanup()
    GPIO.setmode(GPIO.BCM) # Use GPIO/BCM Numbering

    #### Configure I/O ####
    # Trig initial state must be LOW
    GPIO.setup(TRIG, GPIO.OUT, initial = 0)
    GPIO.setup(ECHO, GPIO.IN)
    time.sleep(0.05) # delay 50ms to settle sensor
    return

# Obtain Distance from HC-SR04 Ultrasonic Sensor
def getDistance():
    # returns distance as a string
    # calls ultrasonic executable
    # removes newline \n char at end
    distance = check_output(["sudo", "./ultrasonic"])
    distance = distance[:-1]
    print distance
    return distance

# Obtain current Public IP address (outside of router)
def getPublicIP():
    try:
        # Any website that outputs nothing but
        ##   the IP address in RAW text will work fine.
        # http://icanhazip.com is another alt website to use.
        # TODO: Code fallback website in case primary goes down.
        ip = requests.get('http://ip.42.pl/raw')
        ip = ip.text
    except:
        print "Error getting Public IP"
        response = -2
    else:
        print ip
        response = ip
    finally:
        return response

# From getDistance() calculate fill level of bin as percentage
# empty is bool whether bin needs emptying or not
distance = getDistance()
distance = float(distance)
print distance

fill = 1 - (distance/capacity)
print fill

if(fill > limit):
    empty = 1
else:
    empty = 0

print empty

#### MAIN ####
# payload = {'key1': 'value1', 'key2': 'value2'}
# r = requests.post("http://httpbin.org/post", data=payload)
# print(r.text)
# to getIP, just use 'origin' key.
payload = {'distance':distance, 'fill':fill, 'capacity':capacity, 'empty':empty, 'publicip':getPublicIP(), 'latitude':latitude, 'longitude':longitude, 'key':key, 'deviceID':deviceID}
#r = requests.post("http://58.162.145.29/process.php", data=payload)
r = requests.post("https://inbin.tech/post.php", data=payload)
print "Data Sent!"
print(r.text)


##### CHANGELOG #####
# v0.7 - [11/05/16] -   Program finished. Sending data via POST successfully

# v0.8 - [17/05/16] -   Updated Location co-ordinates to reflect demo location (ROWVILLE, VIC)
#                   -   Added calculations for bin fill level + capacity + whether it requires emptying.

# v0.8 - [09/10/16] -   Updated Location co-ordinates to reflect demo location (EnGenius Tradefair)
#                   -   Updated server IP address to point to new inBin server.
#                   -   Changed bin capacity to match new prototype 80L bin.
#                   -   Changed deviceID to EnGenius_demo,0001 from demo,0001
