<?php
	class Log {
		private $messages = false;	// Array messages ready for recall
		private $level = false;		// Level of which to display messages
		protected $iii = false;
		protected $process = "Unknown";	// Process Name
		private $cli = true;		// Method of displaying messages
		private $rotate = 4;		// How many messages to hold before saving to file
		private $save = true;		// Save old logs to file?
		private $logDir = "./logs/";	// Where to save our logs

		// Para 1: The name of the process or class we are monitoring
		// Para 2: Importance of message to show. Lower you go, more debugging messages you get
		function __construct ($process = false, $level = false) {
			// Are we in command line mode or HTML
			$this->cli = php_sapi_name() == 'cli';

			// Fill in defaults
			if (!is_string($process)) {
				$process = implode(" ", $_SERVER['argv']);
			}
			if (!is_int($level)) {
				$level = 99;
			}
			$this->iii = 0;
			$this->process = $process;
			$this->level = $level;
			$this->messages = array();
			$this->log("Started Logging for: '{$process}'", 0);
			return true;
		}

		public function rotateMessages ($limit = false) {
			if ($GLOBALS['rotatingLogs']) { // Do not write to files whilst rotating
				return false;
			}
			if ($limit === false) {
				$limit = &$this->rotate;
			}
			if (!is_int($limit)) {
				$this->rotate = 10; // Reset ->rotate to prevent climbing Escher's staircase
				$this->log("Invalid datatype for rotateMessages", 5);
				return false;
			}
			if (!is_array($this->messages)) {
				$this->messages = array(); // Once again prevent Escher's staircase
				$this->log("Invalid datatype for logging messages.", 5);
			}
			$ttt = count($this->messages);
			if ($limit > $ttt) {
				// No need to do anything because we are under the limit
				return false;
			}

			$GLOBALS['rotatingLogs'] = true;

			// First split the array to get the part we'd like to save
			$tosave = array_splice($this->messages, 0, floor($limit / 2));
			$filewriter = new FileWriter($this->logDir.$this->process.".log", false);

			foreach ($tosave as $line) {
				if ($filewriter->write($line["time"]."    ".$line["message"].PHP_EOL) === false) {
					$this->log("Failed to write line", 2);
				}
			}
			$filewriter->close();
			$GLOBALS['rotatingLogs'] = false;
			return true;
		}

		// Para 1: The message
		// Para 2: Level of importance, fatal errors should be high
		public function log ($msg = false, $level = 0) {
			if (!is_string($msg) || !is_int($level)) {
				return false;
			}
			$this->messages[$this->iii] = array(
					"message" => $msg,
					"level" => $level,
					"time" => microtime(true)
				);
			if ($level < $this->level) {
				$this->displayMessage($this->iii);
			}
			$this->rotateMessages();
			return $this->iii++;
		}

		// Function that will display the error message
		public function displayMessage ($id = false) {
			if (!is_int($id) || !isset($this->messages[$id])) {
				return false;
			}
			$msg = &$this->messages[$id];
			if ($this->cli) { // Command line mode
				echo "[".$msg["time"]."]    \t".$msg["message"].PHP_EOL;
			} else { // HTML mode
				echo "<span class='time'>",$msg["time"],"</span>",
				     "<span class='message lvl",$msg["level"],"'>".$msg["message"]."</span><br />";
			}
			return true;
		}

		public function showLicense () {
			if ($this->cli) {
				$line = PHP_EOL;
			} else {
				$line = "<br />&nbsp;nbsp;nbsp;nbsp;";
			}
			echo "AutoPlane  Copyright (C) 2012  Paul Hutchinson", $line,
			"    This program comes with ABSOLUTELY NO WARRANTY; for details see license.", $line,
			"    This is free software, and you are welcome to redistribute it", $line,
			"    under certain conditions; see license for details.", $line, $line;
		}
	}
?>
