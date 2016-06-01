/*
Ultrasonic Sensor HC-SR04
Interacts with Sensor on RPi and obtains measurement reading.

Nathan Catania
02/04/16
For Design 3A/Telstra University Challenge, RMIT University

v0.3
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

PIN CONNECTIONS
	Pin Connections are referenced using wiringPi naming
	TRIG --> Pin 5 (GPIO/BCM Pin 24, Physical Pin 18)
	ECHO --> Pin 6 (GPIO/BCM Pin 25, Physical Pin 22)
	GND  --> Physical Pin 18 on RPi
	Vcc  --> Physical Pin 2 or 4 on RPi (both are +5V)

Based on: https://nineof.wordpress.com/2013/07/16/rpi-hc-sr04-ultrasonic-sensor-mini-project/
*/

#include <iostream>
#include <wiringPi.h>

// define wiringPi Pins (using WiringPi Numbering!)
// change these depending on pins used
#define TRIG 5
#define ECHO 6

void setup() {
	wiringPiSetup();	// required to use wiringPi library

	// Setup GPIO Pins for Input/Output
	// TRIG is OUTPUT (From Pi to Sensor)
	// ECHO is INPUT (From Sensor to Volt Divider to Pi)
	pinMode(TRIG, OUTPUT);
	pinMode(ECHO, INPUT);

	// TRIG pin initial state must be LOW
	digitalWrite(TRIG, LOW);
	delay(30);	// delay in milliseconds (ms) - allow to settle
	return;
}

// Distane in mm
double getDistance() {
	// Send TRIG pulse to start sensor
	// Hold HIGH for >10us --> Using 20us to be safe
	// WARNING POTENTIAL SYSTEM IMPACT: delayMicroseconds() uses infinite loop that continuously
	//	polls system time until complete. Delays <100us will do this.
	// After elapsed time, return TRIG to LOW.
	digitalWrite(TRIG, HIGH);
	delayMicroseconds(20);		// delay in microseconds (us)
	digitalWrite(TRIG, LOW);

	// define variables to store time values
	// time values sent by sensor are integers
	long timeStart = 0;
	long timeFinish = 0;

	// Wait for sensor to return pulse
	//std::cout << "Waiting for sensor data...\n";
	while(digitalRead(ECHO) == LOW);
	timeStart = micros();	// will save the time (microseconds) of the instant ECHO goes HIGH

	// Wait for ECHO pulse to end. Record H/L transition as finish time.
	while(digitalRead(ECHO) == HIGH);
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

int main() {

	setup();

	delay(1000); // delay 1s. Running program quickly generates inaccurate measurements.
	std::cout << getDistance() << std::endl;

	return 0;
}
