<?php
	function showLicense () {
		if ($GLOBALS["cli"]) {
			$line = PHP_EOL;
		} else {
			$line = "<br />&nbsp;nbsp;nbsp;nbsp;";
		}
		echo "AutoPlane  Copyright (C) 2012  Paul Hutchinson", $line,
		"    This program comes with ABSOLUTELY NO WARRANTY; for details see license.", $line,
		"    This is free software, and you are welcome to redistribute it", $line,
		"    under certain conditions; see license for details.", $line, $line;
	}
?>
