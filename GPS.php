#!/usr/bin/php
<?php
	// Working Location
	$dir = dirname(__FILE__);
	$classesDir = $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;

	// Get our classes
	include $classesDir."include.php";

	$log = new Log("GPS");

	// Create shared memory where anyone can read- only.
	$shmop = new SHMOP(SHMOP_GPS, "n", 0444, 10485760);

	$i = 0;

	// GPS Daemon
	while (!isset($gpsd)) { // Run once
		$gpsd = new GPSD("127.0.0.1", 2947); // Start a new monitor
		do {
			$data = $gpsd->watch();
			//sleep(2);
			$i++;
		} while ($i < 50000);
	}
?>
