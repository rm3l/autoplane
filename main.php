<?php
	// Working Location
	$dir = dirname(__FILE__);

	// Include Classes
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."defaults.php";	// Must be first
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."log.php";	// Logger
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."gps.php";	// GPS
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."geomath.php";	// Math functions
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."camera.php";	// Camera Capture
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."tilt.php";	// Tilt/Gryo
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."command.php";	// Contact with ground
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."kml.php";	// Parse KML files
	include $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR."flight.php";	// Fight engine

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
	$flight->addWaypoint(new Gps(32, 23, 2532));
	var_dump($kml->generateKml($flight->getDetails()));
?>
