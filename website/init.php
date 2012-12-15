<?php
	// Working Location
	$dir = dirname(dirname(__FILE__));
	$classesDir = $dir.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;

	// Include Classes
	include $classesDir."include.php";

	$GLOBALS["allowLogging"] = false;
?>