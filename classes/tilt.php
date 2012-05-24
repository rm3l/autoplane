<?php
	class Tilt extends Log {
		private $x = false;
		private $y = false;
		function  __construct ($x = false, $y = false) {
			parent::__construct("Tilt");
			$this->log("Creating new Tilt", 0);
			return $this->update(&$x, &$y);
		}

		public function setX ($x = false) {
			if (!is_int($x) && !is_float($x)) {
				if ($x !== false) {
					$this->log("Failed to set Tilt X to {$x}", 0);
				}
				return false;
			}
			$this->log("Setting Tilt X to {$x}", 0);
			$this->x = (float)$x;
			return true;
		}

		public function setY ($y = false) {
			if (!is_int($y) && !is_float($y)) {
				if ($y !== false) {
					$this->log("Failed to set Tilt Y to {$y}", 0);
				}
				return false;
			}
			$this->log("Setting Tilt Y to {$y}", 0);
			$this->y = (float)$y;
			return true;
		}

		public function getDetails () {
			$this->log("Collect tilt details", 0);
			if (!is_float($this->x) || !is_float($this->y)) {
				$this->log("Tilt not valid", 0);
				return false;
			}
			return array(
				"x" => &$this->x,
				"y" => &$this->y
			);
		}

		public function update ($x = false, $y = false) {
			$this->setX(&$x);
			$this->setY(&$y);
			return true;
		}
	}
?>
