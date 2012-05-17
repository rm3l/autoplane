<?php
	// Class to parse KML files for flight paths
	class Kml {
		private $log = false;
		private $file = false;
		private $xml = false;

		function __construct ($file = false) {
			$this->log = new Log("KML");
			$this->log->log("Creating new KML parse engine", 0);
			$this->xml = false;
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
			$this->xml = false;
			$this->log->log("Opening File {$file}", 0);
			$xml = simplexml_load_file($this->file);
			if ($xml === false) {
				$this->log->log("Failed to read XML data", 3);
				return false;
			}

			$this->xml = $xml;
		}

		public function getDetails () {
			return $this->xml;
		}

		public function generateKml ($data = false, $file = false) {
			if (!is_array($data)) {
				$this->log->log("Incorrect datatype for KML", 1);
				return false;
			}
			if ($file !== false && !is_string($file)) {
				if ($file !== false) {
					$this->log->log("File data type is invalid", 2);
				}
				return false;
			}

			// The Head
			$kml = "<kml>";
			$kml.= "<Document>";

			// The Name - REQUIRED
			$kml.= "<name>";
			if (is_string($data["name"])) {
				$kml.= $data["name"];
			} else {
				$kml.= "Unnamed flight";
			}
			$kml.= "</name>";

			// The description
			if (is_string($data["description"])) {
				$kml.= "<description>";
				$kml.= $data["description"];
				$kml.= "</description>";
			}

			// The style
			$kml.= '<Style id="YellowLineGreenPoly"><LineStyle><color>7f00ffff</color><width>4</width></LineStyle><PolyStyle><color>7f00ff00</color></PolyStyle></Style>';

			if (count($data["waypoints"]) > 0) {
				// Placemark Head
				$kml.= "<Placemark>";
				$kml.= "<name>Flight Plan</name>";
				$kml.= "<description>Flight Plan</description>";
				$kml.= "<styleUrl>#yellowLineGreenPoly</styleUrl>";
				$kml.= "<LineString>";

				// Placemark meta
				$kml.= "<extrude>1</extrude><tessellate>1</tessellate><altitudeMode>absolute</altitudeMode>";

				// Now for the coords
				$kml.= "<coordinates>";
				foreach ($data["waypoints"] as $point) {
					$kml.= PHP_EOL;
					$point = $point->getDetails();
					$kml.= $point["lat"].",".$point["long"].",".$point["alt"];
				}
				$kml.= PHP_EOL;
				$kml.= "</coordinates>";

				// Placemark Footer
				$kml.= "</LineString>";
				$kml.= "</Placemark>";
			}

			// The footer
			$kml.= "</Document>";
 			$kml.= "</kml>";

			if ($file !== false) {
				return file_put_contents($file, $contents);
			} else {
				return $kml;
			}
 		}
	}
?>
