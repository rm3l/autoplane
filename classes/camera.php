<?php
	// Requires STREAMER
	class Camera {
		private $log = false;
		private $counter = 0;
		private $quality = 100; // Quality of images
		private $file = "flight_"; // File prefix
		private $rotate = 9999; // How many images to save before writing over files
		private $ext = ".jpeg"; // File extension/suffix
		private $device = "/dev/video0";
		private $size = "320x200";

		function __construct ($file = false, $size = false, $quality = false, $rotate = false) {
			$this->log = new log("Camera");
			$this->log->log("Creating new Camera", 0);
			$this->setFile(&$file);
			$this->setSize(&$size);
			$this->setCounter(0);
			$this->setQuality(&$quality);
			$this->setRotate(&$rotate);
			return true;
		}

		// Take a snap
		public function takePhoto () {
			$this->log->log("Taking snap", 0);
			// Do the validation
			if (!$this->validateDevice(&$this->device) ||
				!$this->validateFile(&$this->file) ||
				!$this->validateSize(&$this->size) ||
				!$this->validateCounter(&$this->counter) ||
				!$this->validateQuality(&$this->quality) ||
				!$this->validateRotate(&$this->rotate)
			) {
				$this->log->log("Validation failed", 1);
				return false;
			}
			$lines = array();
			$code = false;
			$this->counter++;
			// If we have surpassed our rotate size reset
			if ($this->counter > $this->rotate) {
				$this->setCounter(0);
			}
			// TODO: TEST
			$file = $this->file;
			$leading = strlen((string)$this->rotate) - strlen((string)$this->counter); // Add leading zeros
			$file.= str_repeat("0", $leading);
			$file.= $this->counter;
			$file.= $this->ext;
			$command = "streamer -q -c ".$this->device." -s ".$this->size." -o ".$file." -j ".$this->quality;
			$result = exec($command . " 2>&1", $lines, $code);
			$result = implode(PHP_EOL, $lines);
			if ($code !== 0) {
				if (strlen($result) > 1) {
					$this->log->log("Camera Error: {$result} ({$code})", 4);
					return false;
				}
				$this->log->log("Camera Error: Unknown Error ({$code})", 5);
				return false;
			}
			if (strlen($result) > 1) {
				$this->log->log("Camera Warning: {$result}", 1);
				return false;
			}
			return true;
		}

		public function validateDevice ($device = false) {
			if (!is_string($device)) {
				$this->log->log("Invalid datatype for video device", 1);
				return false;
			}
			if (!file_exists($device)) {
				$this->log->log("Device doesn't exist", 2);
				return false;
			}
			return true;
		}

		private function validateCounter ($counter = false) {
			if (!is_int($counter)) {
				if ($counter !== false) {
					$this->log->log("Malformed counter", 1);
				}
				return false;
			}
			return true;
		}

		public function setCounter ($counter = false) {
			if ($this->validatecounter(&$counter) === false) {
				return false;
			}
			$this->counter = &$counter;
			return true;
		}

		private function validateQuality ($quality = false) {
			if (!is_int($quality)) {
				if ($quality !== false) {
					$this->log->log("Malformed quality", 1);
				}
				return false;
			}
			if ($quality > 100 || $quality < 1) {
				$this->log->log("Quality invalid", 4);
				return false;
			}
			return true;
		}

		public function setQuality ($quality = false) {
			if ($this->validateQuality(&$quality) === false) {
				return false;
			}
			$this->quality = &$quality;
			return true;
		}

		private function validateSize ($size = false) {
			if (!is_string($size)) {
				if ($size !== false) {
					$this->log->log("Malformed size", 1);
				}
				return false;
			}
			$size = explode("x", $size);
			if (count($size) !== 2) {
				$this->log->log("Error parsing size", 1);
				return false;
			}
			$size[0] = (int)$size[0];
			$size[1] = (int)$size[1];
			if ($size[0] > 2000 || $size[0] < 300 || $size[1] > 2000 || $size[1] < 200) {
				$size = $size[0]."x".$size[1];
				$this->log->log("Image size (".$size.") is not allowed", 4);
				return false;
			}
			$size = $size[0]."x".$size[1];
			return true;
		}

		public function setSize ($size = false) {
			if (!$this->validateSize(&$size)) {
				return false;
			}
			$this->size = $size;
			return true;
		}

		private function validateFile ($file = false) {
			if (!is_string($file)) {
				if ($file !== false) {
					$this->log->log("Malformed file", 1);
				}
				return false;
			}
			// If we have a max length for a path make sure we can create the file if needed
			if (PHP_MAXPATHLEN > 0 && ((($file[0] === "/" && strlen($file) + count((string)$this->rotate . $this->ext) > PHP_MAXPATHLEN) || strlen(getcwd().$this->rotate.$this->ext) > PHP_MAXPATHLEN))) {
				$this->log->log("File too long", 5);
				return false;
			}
			return true;
		}

		public function setFile($file = false) {
			if (!$this->validateFile(&$file)) {
				return false;
			}
			$this->file = $file;
			return true;
		}

		private function validateRotate ($rotate = false) {
			if (!is_int($rotate)) {
				if ($rotate !== false) {
					$this->log->log("Malformed rotation", 1);
				}
				return false;
			}
			if ($rotate < 10) {
				$this->log->log("Rotation must be great than 9", 2);
			}
			return true;
		}

		public function setRotate ($rotate = false) {
			if (!$this->validateFile(&$rotate)) {
				return false;
			}
			$this->rotate = &$rotate;
			return true;
		}

		public function setDevice ($device = false) {
			if (!$this->validateDevice(&$device)) {
				return false;
			}
			$this->device = $device;
			return true;
		}
	}
?>
