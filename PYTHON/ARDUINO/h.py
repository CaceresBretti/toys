

#!/usr/bin/env python

import serial
import time

# /dev/ttyACM0 = Arduino Uno on Linux
# /dev/ttyUSB0 = Arduino Duemilanove on Linux

def turn_on():
  arduino = serial.Serial('/dev/ttyACM0', 9600)
  time.sleep(2) # waiting the initialization...

  arduino.write('H') # turns LED ON
  time.sleep(1) # waits for 1 second

  arduino.close() #say goodbye to Arduino
