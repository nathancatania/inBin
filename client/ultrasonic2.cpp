/*
Ultrasonic Sensor HC-SR04
Interacts with Sensor on RPi and obtains measurement reading.


05/10/16
For Design 3B/Telstra University Challenge, RMIT University
-> Modified source code to incorporate 2 ultrasonic sensors for final demonstration.

v0.4
(sudo nano ./ultrasonic.cpp)

REQUIRES WIRINGPI LIBRARY TO BE INSTALLED
http://wiringpi.com/download-and-install/

Compile using:
sudo g++ -Wall -o ultrasonic ultrasonic.cpp -lwiringpi

Run using:
sudo ./ultraonsic

Interacts with HC-SR04 Ultrasonic sensor using GPIO Pins on RPi
Sensor has 4 pins: Vcc, ECHO, TRIG, GND
1. Send 5V/HIGH pulse for >10us to TRIG pin to start sensor
2. Sensor sends 8x pulses at 40kHz and measures time to receive back
3. Sensor outputs a 5V pulse on ECHO pin
3a.	Period of pulse (in microseconds) is time taken for sensor to receive pulses back.
3b.	Time taken should be /2 as it is time taken to send pulse to object and back.
3c.	Speed = distance / (time/2)

NB:
	Speed == speed of sound (340m/s - depends on Temp - assume 15 degC avg)
	Distance in cm = Time(us) / 58    (From Datasheet)
	Distance in m  = [340 * [(t/2)/1000000]]
	Distance in mm = [340 * [(t/2)/1000000]]*1000
	/1000000 divisor converts the time t from microseconds to seconds

WARNING:
	RPi can SEND 5V signal, but CANNOT RECEIVE 5V SIGNAL (Max 3.3V)!
	THIS WILL DESTROY THE RPI!
	ECHO PIN WILL OUTPUT 5V TO RPI!
	*MUST* USE VOLTAGE DIVIDER TO BRING VOLT OUTPUT OF ECHO TO 3.3V!
	INPUT to RPi will be connected to Vout of Voltage Divider.
	Use 10k and 4.7k resistors == approx 3.3 V for Vout.

	VIN(ECHO PIN)------------
				|
				4.7k
				|
				----- VOUT to RPi
				|
				10k
				|
				----- GND on RPi

PIN CONNECTIONS (Example)
	Pin Connections are referenced using wiringPi naming
	TRIG --> Pin 5 (GPIO/BCM Pin 24, Physical Pin 18)
	ECHO --> Pin 6 (GPIO/BCM Pin 25, Physical Pin 22)
	GND  --> Physical Pin 18 on RPi
	Vcc  --> Physical Pin 2 or 4 on RPi (both are +5V)

Based on: https://nineof.wordpress.com/2013/07/16/rpi-hc-sr04-ultrasonic-sensor-mini-project/
*/

#include <iostream>
#include <iomanip>
#include <cstdlib>
#include <wiringPi.h>

// define wiringPi Pins (using WiringPi Numbering!)
// change these depending on pins used 0 2
#define TRIG 23
#define ECHO 24
#define TRIG2 23
#define ECHO2 24

// Delay in between measurements (milliseconds)
#define DELAY 200

// Number of measurements to take on each sensor.
// Higher is more accurate but increases runtime by 2xDELAY each increment (400 ms default).
#define LOOP 15



void setup() {
	wiringPiSetup();	// required to use wiringPi library

	// Setup GPIO Pins for Input/Output
	// TRIG is OUTPUT (From Pi to Sensor)
	// ECHO is INPUT (From Sensor to Volt Divider to Pi)
	pinMode(TRIG, OUTPUT);
	pinMode(TRIG2, OUTPUT);
	pinMode(ECHO, INPUT);
	pinMode(ECHO2, INPUT);

	// TRIG pin initial state must be LOW
	digitalWrite(TRIG, LOW);
	digitalWrite(TRIG2, LOW);
	delay(30);	// delay in milliseconds (ms) - allow to settle
	return;
}

// Distane in mm
double getDistance(int TRIGPIN, int ECHOPIN) {
	// Send TRIG pulse to start sensor
	// Hold HIGH for >10us --> Using 20us to be safe
	// WARNING POTENTIAL SYSTEM IMPACT: delayMicroseconds() uses infinite loop that continuously
	//	polls system time until complete. Delays <100us will do this.
	// After elapsed time, return TRIG to LOW.
	digitalWrite(TRIGPIN, HIGH);
	delayMicroseconds(20);		// delay in microseconds (us)
	digitalWrite(TRIGPIN, LOW);

	// define variables to store time values
	// time values sent by sensor are integers
	long timeStart = 0;
	long timeFinish = 0;

	// Wait for sensor to return pulse
	//std::cout << "Waiting for sensor data...\n";
	while(digitalRead(ECHOPIN) == LOW);
	timeStart = micros();	// will save the time (microseconds) of the instant ECHO goes HIGH

	// Wait for ECHO pulse to end. Record H/L transition as finish time.
	while(digitalRead(ECHOPIN) == HIGH);
	timeFinish = micros();
	//std::cout << "[ OK! ] Data Received!\n";

	// calculate period of ECHO
	long travelTime = timeFinish - timeStart;
	//std::cout << "ECHO Pulse Period = " << travelTime << " us.\n";

	// calculate distance in mm
	//double distance = 0.17*travelTime; //also works.
	double distance = (340.0 * ((travelTime/2)/1000000.0))*1000.0;

	return distance;
}

double measure(int TRIGPIN, int ECHOPIN, int num, bool debug) {
	// Get NUM distances measurments from sensor. Return average.

	int i = 0;
	double measurement = 0;
	double distance_avg = 0;
	double distance_sum = 0;

	// calculate sum of 5 measurements
	while(i < num) {

		delay(DELAY);
		i++;
		measurement = getDistance(TRIGPIN, ECHOPIN);
		distance_sum += measurement;
		distance_avg = distance_sum/i;


		// Debug mode only
		if(debug){
			std::cout << "Measurement " << i << ": | Distance (mm) == " << measurement << " | Average (mm) = " << distance_avg << std::endl;
		}
	}

	return distance_avg;
}

void debug(int i) {

	double dist1 = 0.0;
	double dist2 = 0.0;

	while(i > 0) {
		// Loop infinitely until CTRL+C is pressed.
		delay(DELAY); // delay 200ms. Running program quickly generates inaccurate measurements.
		dist1 = getDistance(TRIG, ECHO);

		delay(DELAY);
		dist2 = getDistance(TRIG2, ECHO2);

		std::cout << std::setprecision(2) << std::fixed << "Sensor 1: " << dist1 << "\t Sensor 2: " << dist2 << std::endl;
		i--;
	}

	return;
}

double aggregate(int num, bool debug) {

	double sensor1 = 0;
	double sensor2 = 0;

	sensor1 = measure(TRIG, ECHO, num, debug);
	sensor2 = measure(TRIG2, ECHO2, num, debug);

	double aggregate = (sensor1 + sensor2)/2;

	return aggregate;
}

int main(int argc, char*argv[]) {

	setup();

	// **************** DEBUG MODE *******************
	bool debug = 0;
	if(argc > 1){
		// Enable debug mode
		debug = 1;
	}

	if(debug) {
		std::cout << std::endl;
		std::cout << "****************************************************************" << std::endl << std::endl;
		std::cout << "WARNING! ARGUMENT ENTERED AT RUNTIME: DEBUG MODE ENABLED!" << std::endl;
		std::cout << "VERBOSE OUTPUT WILL OCCUR!" << std::endl << std::endl;
		std::cout << "THIS MODE IS UNSUITABLE FOR PRODUCTION USE!" << std::endl;
		std::cout << "COMMUNICATION TO SERVER WILL FAIL WITH THIS TURNED ON!" << std::endl << std::endl;
		std::cout << "RUN THE EXECUTABLE WITHOUT ANY ARGUMENTS FOR NORMAL OPERATION." << std::endl << std::endl;
		std::cout << "****************************************************************" << std::endl << std::endl;

		std::cout << "Sensor #1, 15 measurement average... START!" << std::endl <<  "********************************" << std::endl;
		measure(TRIG, ECHO, LOOP, debug);
		std::cout << std::endl;
		std::cout << "Sensor #2, 15 measurement average... START!" << std::endl <<  "********************************" << std::endl;
		measure(TRIG2, ECHO2, LOOP, debug);
		std::cout << std::endl;
		return 0;
	}
	// **************** END OF DEBUG MODE *******************


	// Server communication script will get terminal output. Expects a number only.
	std::cout << aggregate(LOOP, debug) << std::endl;

	return 0;
}
