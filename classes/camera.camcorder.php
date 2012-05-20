<?php
	// Stopped DEV because unable to test on my device
	class Camcorder extends Camera {
		private $ext = ".avi";
		private $length = 10; // Seconds

		function __construct($file = false, $size = false, $quality = false, $rotate = false) {
			parent::__construct(&$file, &$size, &$quality, &$rotate);
		}

		public function validateLength ($length) {
			if (!is_int($length)) {
				if ($length !== false) {
					$this->log->log("Invalid datatype for Video Length", 1);
				}
				return false;
			}
			if ($length < 0 || $length > 86400) {
				$this->log->log("Video length invalid", 2);
				return false;
			}
			return true;
		}

		public function setLength ($length = false) {
			if (!validateLength(&$length)) {
				return false;
			}
			$this->length = &$length;
			return true;
		}

		// Take a snap
		public function takeVideo ($fork = false) {
			$this->log->log("Taking video", 0);
			// Do the validation
			if (!$this->validateDevice(&$this->device) ||
				!$this->validateFile(&$this->file) ||
				!$this->validateSize(&$this->size) ||
				!$this->validateCounter(&$this->counter) ||
				!$this->validateQuality(&$this->quality) ||
				!$this->validateRotate(&$this->rotate) ||
				!$this->validateLength(&$this->length)
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
					$this->log->log("Camcorder Error: {$result} ({$code})", 4);
					return false;
				}
				$this->log->log("Camcorder Error: Unknown Error ({$code})", 5);
				return false;
			}
			if (strlen($result) > 1) {
				$this->log->log("Camcorder Warning: {$result}", 1);
				return false;
			}
			$this->log->log("Video Saved!", 0);
			return true;
		}
	}
?>
