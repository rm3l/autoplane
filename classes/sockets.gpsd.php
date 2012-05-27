<?php
	class GPSD extends Socket {
		private $completed = true; // Are we sending or receving
		private $data = false; // Use as a light weight cache thing

		function __construct () {
			parent::__construct("127.0.0.1", 2947);
			$this->connect();
			$this->write("?WATCH={\"enable\":true};\n");
		}

		public function poll () {
			// We have completed everything so need to start again by asking for a new location
			if ($this->completed) {
				$this->log("Requesting GPS Update", 0);
				$this->completed = false;
				return $this->write("?POLL;\n"); // Send new request
			}
			$matches = array();
			if (!preg_match('/{"class":"POLL".+}/i', $this->read(2000), $matches)) {
				$this->log("No match for GPS data this time round. Not an error.", 0);
				return false;
			}
			$data = json_decode($matches[0], true);
			if (!is_array($data)) {
				$this->log("Failed to decode JSON, this could be bad", 5);
				return false;
			}
			// Store the value for cache like effect
			if (isset($data["sky"])) {
				$sky = current($data["sky"]); // We are only using one device
				if (!is_array($sky)) { // Shouldn't happen but we need to catch them anyway
					$this->log("No sky found", 1);
				} else {
					$satellites = $sky["satellites"];
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
