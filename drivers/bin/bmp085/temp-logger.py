#!/usr/bin/python

from Adafruit_BMP085 import BMP085
import time

# ===========================================================================
# Example Code
# ===========================================================================

# Initialise the BMP085 and use STANDARD mode (default value)
# bmp = BMP085(0x77, debug=True)
bmp = BMP085(0x77)

# To specify a different operating mode, uncomment one of the following:
# bmp = BMP085(0x77, 0)  # ULTRALOWPOWER Mode
# bmp = BMP085(0x77, 1)  # STANDARD Mode
# bmp = BMP085(0x77, 2)  # HIRES Mode
bmp = BMP085(0x77, 3)  # ULTRAHIRES Mode

while 1:
	temp = bmp.readTemperature()
	pressure = bmp.readPressure()
	altitude = bmp.readAltitude()
	localtime = time.asctime( time.localtime(time.time()) )
	print str(localtime) + "," + str(temp) + "," + str(pressure) + "," + str(altitude)
	time.sleep(3);
