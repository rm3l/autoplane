<?php
	class GPSD extends Socket {
		private $completed = true; // Are we sending or receving
		private $data = false; // Use as a light weight cache thing

		function __construct ($host = false, $port = false) {
			// Create a connection
			parent::__construct($host, $port);
			$this->connect();

			// This gets the header
			$this->processData();

			// Turn montioring on, in JSON format
			$this->write("?WATCH={\"enable\":true,\"json\":true};\n");

			// Process device information (meta data)
			$this->processData();

			// See if we did turn watch mode on
			$this->processData();

			$this->processData();

			return true;
		}

		private function processData () {
			$data = json_decode($this->read(2048), true);
			if (!is_array($data)) {
				$this->log("Failed to decode data. This could cause a hang later on", 6);
				return false;
			}
			if (!isset($data["class"])) {
				$this->log("Missing import class information", 7);
				return false;
			}
			if ($data["class"] === "WATCH") {
				return $this->processWatch($data);
			}
			if ($data["class"] === "VERSION") {
				return $this->processVersion($data);
			}
			if ($data["class"] === "DEVICES") {
				return $this->processDevices($data);
			}
			if ($data["class"] === "TPV") {
				return $this->processTPV($data);
			}
			var_dump($data);
			$this->log("Unknown class type: '{".$data["class"]."}'", 4);
			return false;
		}

		private function processTPV (&$data) {
			var_dump($data);
			if ($data["mode"] < 1) {
				$this->log("Unknown GPS fix type {'".$data["mode"]."'}", 3);
			}
			if ($data["mode"] === 1) {
				$this->log("No GPS Fix", 1);
				return false;
			}
			if ($data["mode"] === 2) {
				$this->log("Got 2D fix", 0);
			}
			if ($data["mode"] === 3) {
				$this->log("Got 3D fix", 0);
			}
			return $data;
		}

		public function watch () {
			return $this->processData();
		}

		private function processWatch (&$data) {
			if (!$data["enable"]) {
				$this->log("Failed to turn watch mode on", 7);
				return false;
			}
			if (!$data["json"]) {
				$this->log("Output mode is not JSON", 5); // Defaults to JSON anyway so shouldnt be a biggy
				return false;
			}
			$this->log("Watch mode on", 0);
			return true;
		}

		private function processVersion (&$data) {
			$protocol = $data["proto_major"] + $data["proto_minor"] / 10;
			$this->log("Using GPS; Release: ".$data["release"].", Revision: ".$data["rev"].", Protocol: ".$protocol, 0);
			if ($protocol !== 3.6) {
				$this->log("Protocol version unsupported! ({$protocol})", 20); // Really high as requested in the gpsd documentation
			}
			return true;
		}

		private function processDevices (&$data) {
			if (count($data["devices"]) === 0) {
				$this->log("No devices found. Good luck getting a GPS fix", 2);
				return false;
			}
			foreach ($data["devices"] as $device) {
				$this->log($device["class"]."; Path: ".$device["path"].", Activated: ".$device["activated"].", Driver: ".$device["driver"].", BPS: ".$device["bps"]);
			}
			return true;
		}

		// Used for ?POLL;
		public function processPoll (&$data) {
			if (isset($data["sky"])) {
				$sky = current($data["sky"]); // We are only using one device
				if (!is_array($sky)) { // Shouldn't happen but we need to catch them anyway
					$this->log("No sky found", 1);
				} else {
					if (!isset($sky["satellites"])) {
						$satellites = false;
					} else {
						$satellites = $sky["satellites"];
						$satCount($satellites);
					}
					$satCount = count($satellites);
					if (!is_array($satellites) || $satCount < 1) { // No satellites
						$this->log("Couldn't find any satellites", 0);
					} else {
						$used = 0; // Count the ones we used
						foreach ($satellites as $satellite) {
							if ($satellite["used"]) {
								$used++;
							}
						}
						$this->log("Using {$used} out of ".$satCount." satellites", 0);
					}
				}
			}
			$this->data = &$data;
			return $this->data;
		}
	}
?>
