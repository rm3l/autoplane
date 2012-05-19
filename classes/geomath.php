<?php
	class GeoMath {
		private $log = false;
		function __construct () {
			$this->log = new log("Math");
			$this->log->log("Creating new Math Engine", 0);
		}

		private function validateGps ($gps1 = false, $gps2 = false, $unit = false) {
			if (!is_array($gps1) || !is_array($gps2)) {
				$this->log->log("Failed to read GPS data", 10);
				return false;
			} elseif($unit !== true && ($unit !== "M" && $unit !== "N" && $unit !== "K")) {
				$this->log->log("Failed to read required output type", 10);
				return false;
			}
			return true;
		}

		// Converts a bearing to English
		public function bearingToEng ($bearing = false) {
			$this->log->log("Converting bearing to English", 0);
			if (!is_int($bearing) || $bearing > 360 || $bearing < 0) {
				$this->log->log("Malformed Bearing", 1);
			}
			$bearing = round($bearing / 22.5);
			switch($bearing) {
				case 1:
					$direction = "NNE";
					break;
				case 2:
					$direction = "NE";
					break;
				case 3:
					$direction = "ENE";
					break;
				case 4:
					$direction = "E";
					break;
				case 5:
					$direction = "ESE";
					break;
				case 6:
					$direction = "SE";
					break;
				case 7:
					$direction = "SSE";
					break;
				case 8:
					$direction = "S";
					break;
				case 9:
					$direction = "SSW";
					break;
				case 10:
					$direction = "SW";
					break;
				case 11:
					$direction = "WSW";
					break;
				case 12:
					$direction = "W";
					break;
				case 13:
					$direction = "WNW";
					break;
				case 14:
					$direction = "NW";
					break;
				case 15:
					$direction = "NNW";
					break;
				default:
					$direction = "N";
			}
			return $direction;
		}


		// Passing two GPS locations will produce a bearing 0-360
		public function bearing ($gps1 = false, $gps2 = false) {
			$this->log->log("Getting bearing from two points", 0);
			if (!$this->validateGps($gps1, $gps2, true)) {
				return false;
			}

			$lat1	= &$gps1["lat"];
			$long1	= &$gps1["long"];
			$lat2	= &$gps2["lat"];
			$long2	= &$gps2["long"];

			return (rad2deg(atan2(sin(deg2rad($long2) - deg2rad($long1)) * cos(deg2rad($lat2)), cos(deg2rad($lat1)) * sin(deg2rad($lat2)) - sin(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($long2) - deg2rad($long1)))) + 360) % 360;
		}

		// Gets the speed in Miles/Kilometers or Nautical miles
		public function speed ($gps1 = false, $gps2 = false, $unit = "M") {
			$this->log->log("Getting speed from two points", 0);
			if (!$this->validateGps(&$gps1, &$gps2, &$unit)) {
				return false;
			}
			$distance = $this->distance(&$gps1, &$gps2, &$unit);
			if ($distance === false) {
				return false;
			}
			$time = $gps2["time"] - $gps1["time"];
			if ($time < 0) {
				$time = -$time;
			}
			$speed = $distance / ($time * 60);
			return $speed;
		}

		// Gets the distance between two points in Miles/Kilometers or Nautical miles
		public function distance ($gps1 = false, $gps2 = false, $unit = "M") {
			$this->log->log("Getting distance from two points", 0);
			if (!$this->validateGps($gps1, $gps2, $unit)) {
				return false;
			}

			$lat1	= &$gps1["lat"];
			$long1	= &$gps1["long"];
			$lat2	= &$gps2["lat"];
			$long2	= &$gps2["long"];

			$theta	= $long1 - $long2;
			$dist	= sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
			$dist	= acos($dist);
			$dist	= rad2deg($dist);
			$miles	= $dist * 60 * 1.1515;

			if ($unit === "K") { // Kilometers
				return $miles * 1.609344;
			} else if ($unit === "N") { // Nautical Miles
				return $miles * 0.8684;
			} else { // The correct answer
				return $miles;
			}
		}

		private function validateTilt ($tilt = false) {
			if (!is_array($tilt) || !is_float($tilt["x"]) || !is_float($tilt["y"])) {
				$this->log->log("Tilt invalid", 2);
				return false;
			}
			return true;
		}

		public function rollTo ($tilt1 = false, $tilt2 = false) {
			$this->log->log("Calculating required roll");
			if (!$this->validateTilt(&$tilt1) || !$this->validateTilt(&$tilt2)) {
				return false;
			}
			return array(
				$tilt2["x"] - $tilt1["x"],
				$tilt2["y"] - $tilt1["y"]
			);
		}
	}
?>
