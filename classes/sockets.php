<?php
	class Socket extends Log {
		private $connection = false;	// The resource
		private $location = false;	// Socket location (unix:///data/sockets/gpsd)
		private $port = -1;		// Have a guess
		private $errno = false;		// Socket Error number
		private $errstr = false;	// Socket Error string
		private $timeout = 3;		// How long to wait?

		function __construct ($location = false, $port = false) {
			parent::__construct("Socket");
			$this->log("Creating new Socket", 0);
			$this->setLocation(&$location);
			$this->setPort(&$port);
			return true;
		}

		public function connect ($location = false, $port = false) {
			$this->setLocation(&$location);
			$this->setPort(&$port);
			if (is_resource($this->connection)) {
				$this->log("Not opening socket because it's already open", 2);
				return false;
			}
			$this->connection = fsockopen($this->location, $this->port, $this->errno, $this->errstr, $this->timeout);
			if (!is_resource($this->connection)) {
				$this->log("Failed to open socket: (".$this->errno.") ".$this->errstr, 3);
				return false;
			}
			$this->log("Opened Socket", 0);
			return true;
		}

		public function write ($data = false) {
			if (!is_resource($this->connection)) {
				$this->log("Cannot write from socket because it's not open", 2);
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
			if (!is_int($bytes) || $bytes < 10 || $bytes > 52428800) {
				$this->log("Invalid datatype for bytes, or bytes requested to high or low", 2);
				return false;
			}
			$this->log("Reading {$bytes} bytes from Socket", 0);
			$data = fread($this->connection, $bytes);
			if (!is_string($data)) {
				$this->log("Failed to read from stream", 2);
				return false;
			}

			return $data;
		}

		public function close ($quite = false) {
			if (!is_resource($this->connection)) {
				if (!$quite) {
					$this->log("Failed to close socket because it has being created", 2);
				}
				return false;
			}
			if (!fclose($this->connection)) {
				if (!$quite) {
					$this->log("Failed to close socket", 3);
				}
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
			$this->location = $location;
			return true;
		}

		public function setPort ($port = false) {
			if (!is_int($port)) {
				if ($port !== false) {
					$this->log("Port is an invalid datatype", 1);
				}
				return false;
			}
			$this->log("Setting port to {$port}");
			$this->port = $port;
			return true;
		}

		function __destruct () {
			$this->log("Closing Socket", 0);
			$this->close(true);
		}
	}
?>
