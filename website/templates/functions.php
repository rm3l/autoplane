<?
function bytes2human($bytes = false, $decimals = 2) {
	if ((!is_int($bytes) && !is_float($bytes)) || !is_int($decimals)) {
		return false;
	}
	$sz = "BKMGTP";
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function getRam () {
	$fh = fopen('/proc/meminfo', 'r');
	$mem = 0;
	$pieces = array(); // tmp
	$data = array(); // final
	while ($line = fgets($fh)) {
		$pieces = explode(':', $line);
		$key = trim($pieces[0]);
		$data[$key] = (int)trim(str_replace('kB', '', $pieces[1])) * 1024;
	}
	return $data;
}
?>
