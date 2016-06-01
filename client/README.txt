Put these files in the home directory of Raspbian on a Raspberry Pi 3.

Ultrasonic.cpp:
  C++ code to interact with HC-SR04 ultrasonic sensor on Raspberry Pi.
  Outputs distance to object in millimeters.
  Very no validity checking (is output reasonable?). Sometimes will randomly return an incorrect measurement.
  
  Depends on wiringPi library, so this must be installed (http://wiringpi.com/download-and-install/).
  
  Compile using g++. There are specific wiringPi arguments that must be used.
  Executable must be called "ultrasonic".
  
  Compile:
    g++ -Wall -o ultrasonic ultrasonic.cpp -lwiringPi
    
  Run (sudo MUST be used!):
    sudo ./ultrasonic
    
    
measure.py:
  Python script executed client-side. Sends data to server using HTTP POST.
  Depends on Python "requests". This is installed by default in Raspbian.
  
  Runs subprocess shell command to ultrasonic program. Captures output as distance.
      Note that a C++ executable is used instead of having this functionality within the script itself as Python is inaccurate (timing wise) for obtaining HC-SR04 measurments.
          Using WiringPi we can get ECHO time to closest microsecond. Python is closest hundred milliseconds.
          ECHO pulse is microseconds long.
            150 us = 0.000450s -> Python .time() rounds to 0.000s or 0.1s (example). C++ we can get exact microseconds.
  Obtains Public IP address of sensor (for SSH access) as this changes due to MBB having dynamic IP.
  Device ID, Location Co-ordinates of sensor (Latitude and Longitude) are hardcoded. Change these for each sensor.
  Sends all of the above data (including a hardcoded key for server-side authentication) via HTTP POST using requests to server.
