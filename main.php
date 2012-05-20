<?php
	// The stricter we are, the quicker the program should run
	error_reporting(E_STRICT);

	// Working Location
	$dir = dirname(__FILE__);
	$classesDir = $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;

	// Include Classes
	include $classesDir."defaults.php";	// Must be first
	include $classesDir."log.php";		// Logger
	include $classesDir."gps.php";		// GPS
	include $classesDir."geomath.php";	// Math functions
	include $classesDir."camera.php";	// Camera Capture
	include $classesDir."tilt.php";		// Tilt/Gryo
	include $classesDir."command.php";	// Contact with ground
	include $classesDir."kml.php";		// Parse KML files
	include $classesDir."flight.php";	// Fight engine
	include $classesDir."filewriter.php";	// File writing engine
	include $classesDir."functions.php";	// Other Functions

	$log  = new Log ("Main");
	// Use the main log to show license
	$log->showLicense();

	$log->log("PHP Version: ".PHP_VERSION, 0);
	if ((string)PHP_INT_MAX !== "2147483647") {
		$log->log("Hmm... Special INT Max (". (PHP_INT_MAX) .")", 1);
	}
	$gps1 = new GPS (25, 21, 9, microtime(true));
	$gps2 = new GPS (25, 20, 3, microtime(true));
	$tilt1 = new Tilt (100, 20);
	$tilt2 = new Tilt (-30, 10);
	$math = new GeoMath();

	$math->distance($gps1->getDetails(), $gps2->getDetails());
	$math->speed($gps1->getDetails(), $gps2->getDetails());
	$math->bearingToEng($math->bearing($gps1->getDetails(), $gps2->getDetails()));
	$math->rollTo($tilt1->getDetails(), $tilt2->getDetails());

	$cnc = new CommandAndControl ("http://flight.youngfreeandginger.co.uk/");

	$kml = new kml ("./flights/test.kml");
	$kml->parse();
	$flight = new Flight($kml->getDetails());
	$flight->addWaypoint(new Gps(-112.242073428656, 36.02626019082147, 2100));
	var_dump($kml->generateKml($flight->getDetails(), "./flights/demo.kml"));
?>
