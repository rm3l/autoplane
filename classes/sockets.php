<?php
	class Socket extends Log {
		private $connection = false;	// The resource
		private $location = false;	// Socket location (unix:///data/sockets/gpsd)
		private $port = 0;		// Have a guess
		private $errno = false;		// Socket Error number
		private $errstr = false;	// Socket Error string
		private $timeout = 5;		// How long to wait?

		function __construct ($location = false, $port = false) {
			parent::__construct("Socket");
			$this->log("Creating new Socket", 0);
			$this->setLocation(&$location);
			$this->setPort(&$port);
			return true;
		}

		public function create ($domain = false, $type = false, $protocol = false) {
			if (!is_int($domain) || !is_int($type) || !is_int($protocol)) {
				$this->log("Missing parameters or parameters have the wrong datatype", 1);
				return false;
			}
			if (!in_array($domain, array(AF_INET, AF_INET6, AF_UNIX))) {
				$this->log("Unknown domain for socket creation", 5);
				return false;
			}
			if (!in_array($type, array(SOCK_STREAM, SOCK_DGRAM, SOCK_SEQPACKET, SOCK_RAW, SOCK_RDM))) {
				$this->log("Unknown type of comunication for socket", 5);
				return false;
			}
			$this->connection = @socket_create($domain, $type, $protocol);
			if ($this->connection === false) {
				$this->_socketError();
				return false;
			}
			return true;
		}

		private function _socketError() {
			$errno = socket_last_error();
			if ($errno < 1) {
				return false;
			}
			$this->log("Socket error ({$errno}) - ".socket_strerror($errno), 5);
			socket_clear_error();
			return true;
		}

		public function bind ($location = false, $port = false) {
			$this->setLocation(&$location);
			$this->setPort(&$port);
			if (socket_bind($this->connection, $this->location, $this->port) === false) {
				$this->_socketError();
				return false;
			}
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

		public function send ($data = false, $length = 0) {
			if (!$this->_validateWrite($data)) {
				return false;
			}
			if (!is_int($length) || $length < 0) {
				$this->log("Invalid datatype for send length, or it is less than 1 byte", 2);
			}
			return socket_write($this->connection, $data, $length);
		}

		public function _validateWrite($data = false) {
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
			return true;
		}

		public function write ($data = false) {
			if (!$this->_validateWrite($data)) {
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
			$start = null;
			$data = fgets($this->connection, $bytes);
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
			$this->start = microtime(true);
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

