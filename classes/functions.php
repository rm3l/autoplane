<?php
	function shutdown () {
		global $log; // Use main log
		if (is_object($log)) {
			$log->log("Memory peak usage ". bytes2human(memory_get_peak_usage(true)), 50);
		}
	}

	register_shutdown_function("shutdown");

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

	function bytes2human($bytes = false, $decimals = 2) {
		if (!is_int($bytes) || !is_int($decimals)) {
			return false;
		}
		$sz = "BKMGTP";
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
	}

	// Stolen from http://php.net/manual/en/function.feof.php
	function safe_feof($fp, &$start = null) {
		$start = microtime(true);
		return feof($fp);
	}
?>
