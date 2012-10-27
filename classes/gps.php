<?php
	class GPS extends Log {
		private $lat = false;	// Latitude
		private $long = false;	// Longitude
		private $alt = false;	// Altitude
		private $time = false;	// The time
		private $dop = false;	// Dilution of Precision

		function __construct ($lat = false, $long = false, $alt = false, $time = false, $dop = false) {
			parent::__construct("GPS");
			$this->log("Creating new GPS Point", 0);
			$this->tab(1);
			$this->update($lat, $long, $alt, $time, $dop);
			$this->tab(-1);
			return true;
		}

		public function setDop (&$dop = false) {
			if (!is_int($dop)) {
				if ($dop !== false) {
					$this->log("Failed to set Dilution of Precision to {$dop}", 0);
				}
				return false;
			}
			$this->log("Setting Latitude to {$dop}", 0);
			$this->dop = $dop;
			return true;
		}

		public function setLat (&$lat = false) {
			if (!is_int($lat) && !is_float($lat)) {
				if ($lat !== false) {
					$this->log("Failed to set Latitude to {$lat}", 0);
				}
				return false;
			}
			$this->log("Setting Latitude to {$lat}", 0);
			$this->lat = (float)$lat;
			return true;
		}

		public function setLong (&$long = false) {
			if (!is_int($long) && !is_float($long)) {
				if ($long !== false) {
					$this->log("Failed to set Longitude to {$long}", 0);
				}
				return false;
			}
			$this->log("Setting Longitude to {$long}", 0);
			$this->long = (float)$long;
			return true;
		}

		public function setAlt (&$alt = false) {
			if (!is_int($alt) && !is_float($alt)) {
				if ($alt !== false) {
					$this->log("Failed to set Altitude to {$alt}", 0);
				}
				return false;
			}
			$this->log("Setting Altitude to {$alt}", 0);
			$this->alt = (float)$alt;
			return true;
		}

		public function setTime (&$time = false) {
			if (!is_int($time) && !is_float($time)) {
				if ($time !== false) {
					$this->log("Failed to set Time to {$time}", 0);
				}
				return false;
			}
			$this->log("Setting Time to {$time}", 0);
			$this->time = (float)$time;
			return true;
		}

		public function getDetails () {
			if ($this->lat === false || $this->long === false) {
				return false;
			}
			return array(
					"lat" => &$this->lat,
					"long" => &$this->long,
					"alt" => &$this->alt,
					"time" => &$this->time,
					"dop" => &$this->dop
				);
		}

		public function update ($lat = false, $long = false, $alt = false, $time = false, $dop = false) {
			$this->log("Updaing GPS", 0);
			$this->tab(1);
			$this->setLat($lat);
			$this->setLong($long);
			$this->setAlt($alt);
			$this->setTime($time);
			$this->setDop($dop);
			$this->tab(-1);
		}
	}
?>
