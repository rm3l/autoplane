<?php
	// Class to parse KML files for flight paths
	class Kml {
		private $log = false;
		private $file = false;
		private $xml = false;

		function __construct ($file = false) {
			$this->log = new Log("KML");
			$this->log->log("Creating new KML parse engine", 0);
			$this->file = $file;
		}

		public function parse ($file = false) {
			if (is_string($file)) {
				$this->file = $file;
			}
			if (!is_string($this->file)) {
				$this->log->log("Malformed file", 1);
				return false;
			}
			if (!file_exists($this->file)) {
				$this->log->log("File doesn't exist", 2);
				return false;
			}
			$this->log->log("Opening File {$file}", 0);
			$xml = simplexml_load_file($this->file);
			if ($xml === false) {
				$this->log->log("Failed to read XML data", 3);
				return false;
			}

			// TO DO :: CONVERT EVERYTHING TO ARRAY
			// EXTRACT THE LIST OF POINTS FOR THE LANDMARK
			$this->xml = $xml;
		}

		public function getDetails () {
			return $this->xml;
		}
	}
?>
