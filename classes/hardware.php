<?php
	class Socket extends Log {
		private $connection = false;	// The resource
		private $location = false;	// Socket location (unix:///data/sockets/gpsd)
		private $errno = false;		// Socket Error number
		private $errstr = false;	// Socket Error string

		function __construct ($location = false) {
			parent::__construct("Socket");
			$this->log("Creating new Socket", 0);
			$this->setLocation(&$location);
			return true;
		}

		public function create () {
			if (!is_resource($this->connection)) {
				$this->log("Not opening socket because it's already open", 2);
				return false;
			}
			$this->connection = fsockopen($this->location, null, $this->errno, $this->errstr);
			if (!is_resource($this->connection)) {
				$this->log("Failed to open socket: (".$this->errno.") ".$this->errstr, 3);
				return false;
			}
			return true;
		}

		public function write ($data = false) {
			if (!is_resource($this->connection)) {
				$this->log("Cannot read from socket because it's not open", 2);
				return false;
			}
			if (!is_string($data)) {
				$this->log("Data to write is in wrong datatype", 2);
				return false;
			}
			if (strlen($data) < 1) {
				$this->log("Data too short", 3);
				return false;
			}
			$write = fwrite($this->connection, $data);
			if ($data === false) {
				$this->log("Failed to write to the socket", 3);
				return false;
			}
			return $data;
		}

		public function read ($bytes = false) {
			if (!is_resource($this->connection)) {
				$this->log("Cannot read from socket because it's not open", 2);
				return false;
			}
			// Infinite bytes
			if ($bytes === false) {
				$data = fgets($this->connection);
			// Bytes > 10b AND Bytes < 50MB
			} elseif (is_int($bytes) && $bytes > 10 && $bytes < 52428800) {
				$data = fgets($this->connection, $bytes);
			// Bugger error
			} else {
				$this->log("Invalid datatype for bytes", 2);
				return false;
			}

			if (!is_string($data)) {
				$this->log("Failed to read from stream", 2);
				return false;
			}

			return $data;
		}

		public function close () {
			if (!is_resource($this->connection)) {
				$this->log("Failed to close socket because it has being created", 2);
				return false;
			}
			if (!fclose($this->connection)) {
				$this->log("Failed to close socket", 3);
				return false;
			}
			return true;
		}

		public function setLocation ($location = false) {
			if (!is_string($location)) {
				if ($location !== false) {
					$this->log("Location is an invalid datatype", 1);
				}
				return false;
			}
			/*	Commented out because some sockets we can't check if it exists
			if (!file_exists($location)) {
				$this->log("Location for socket doesn't exist", 2);
				return false;
			}*/
			$this->location = $location;
			return true;
		}
	}
?>
