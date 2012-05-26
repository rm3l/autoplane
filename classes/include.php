<?php
	// Include Classes
	include $classesDir."defaults.php";		// Must be first
	include $classesDir."log.php";			// Logger
	include $classesDir."gps.php";			// GPS
	include $classesDir."geomath.php";		// Math functions
	include $classesDir."camera.php";		// Camera Capture
	//include $classesDir."camera.camcorder.php";	// Video Capture
	include $classesDir."tilt.php";			// Tilt/Gryo
	include $classesDir."command.php";		// Contact with ground
	include $classesDir."kml.php";			// Parse KML files
	include $classesDir."flight.php";		// Fight engine
	include $classesDir."filewriter.php";		// File writing engine
	include $classesDir."sockets.php";		// Hardware, Socket
	include $classesDir."sockets.gpsd.php";		// GPSD
	include $classesDir."functions.php";		// Other Functions
?>
