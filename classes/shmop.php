<?php
	class SHMOP extends Log {
		private $key = false;
		private $flags = false;
		private $mode = 0;
		private $size = 0;
		private $connection = false; // Have we open a connection?

		function __construct ($key = false, $flags = false, $mode = false, $size = false) {
			parent::__construct("SHMOP");
			$this->log("Created new SHMOP class", 0);
			$a = $this->setKey($key);
			$b = $this->setFlags($flags);
			$c = $this->setMode($mode);
			$d = $this->setSize($size);
			if ($a && $b && $c && $d) {
				$this->open();
			}
			return true;
		}

		public function open ($key = false, $flags = false, $mode = false, $size = false) {
			$this->setKey($key);
			$this->setFlags($flags);
			$this->setMode($mode);
			$this->setSize($size);
			if (!$this->validate()) {
				$this->log("Validation failed", 1);
				return false;
			}
			$this->log("Opening shared memory", 0);
			$this->connection = shmop_open($this->key, $this->flags, $this->mode, $this->size);
			if($this->connection === false) {
				$this->log("Failed to open shared memory at '".$this->key."'", 2);
				return false;
			}
			$this->log("Shared memory opened", 0);
			return true;
		}

		public function write ($data = false) {
			if (!is_string($data)) {
				$this->log("Invalid datatype for data to write", 2);
				return false;
			}
			if (!is_int($this->connection) || $this->connection < 1) {
				$this->log("Memory segment not open", 3);
				return false;
			}
			// Add white space at the end
			$diff = strlen($data) - $this->size;
			if ($diff > 0) {
				$data = $data . str_repeat(0x00, $diff);
			}
			return shmop_write($this->connection, $data, 0);
		}

		public function validate() {
			if (!is_int($this->key) || !is_string($this->flags) || !is_int($this->mode) || !is_int($this->size)) {
				return false;
			}
			return true;
		}

		public function setSize ($size = false) {
			if (!is_int($size)) {
				if ($size !== false) {
					$this->log("Invalid datatype for size", 1);
				}
				return false;
			}
			$this->size = $size;
			return true;
		}

		public function setMode ($mode = false) {
			if (!is_int($mode)) {
				if ($mode !== false) {
					$this->log("Invalid datatype for mode", 1);
				}
				return false;
			}
			$this->mode = $mode;
			return true;
		}

		public function setFlags ($flags = false) {
			if (!is_string($flags) || strlen($flags) !== 1) {
				if ($flags !== false) {
					$this->log("Invalid datatype for flags or incorrect string length", 1);
				}
				return false;
			}
			$flags = strtolower($flags);
			if (!in_array($flags, array("a", "c", "w", "n"))) {
				$this->log("Unknown flag '{$flags}'", 2);
				return false;
			}
			$this->flags = $flags;
			return true;
		}

		public function getKey () {
			if (!is_int($key)) {
				$this->log("Key has not being set", 1);
				return false;
			}
			return $this->key;
		}

		public function setKey ($key = false) {
			if (!is_int($key)) {
				if ($key !== false) {
					$this->log("Invalid datatype for key", 1);
				}
				return false;
			}
			$key = $key + SHMOP_SALT;
			if ($key < 1 || $key > 6193164) {
				$this->log("Cannot set key to '{$key}'", 1);
				return false;
			}
			$this->key = $key;
			return true;
		}

		function __destruct () {
			if (is_int($this->connection) && $this->connection !== 0) {
				shmop_delete($this->connection);
				shmop_close($this->connection);
				$this->log("Closed and deleted our SHMOP", 0);
				return true;
			}
			if (is_int($this->key) && $this->key !== 0) {
				shmop_delete($this->key);
				shmop_close($this->key);
				$this->log("Closed and deleted someones SHMOP", 1);
				return true;
			}
		}
	}
?>
