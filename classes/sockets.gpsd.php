<?php
	class GPSD extends Socket {
		private $completed = true; // Are we sending or receving
		private $data = false; // Use as a light weight cache thing

		function __construct () {
			parent::__construct("127.0.0.1", 2947);
			$this->connect();
			$this->write("?WATCH={\"enable\":true};\n");
		}

		public function poll () {
			// We have completed everything so need to start again by asking for a new location
			if ($this->completed) {
				$this->log("Requesting GPS Update", 0);
				$this->completed = false;
				return $this->write("?POLL;\n"); // Send new request
			}
			$matches = array();
			if (!preg_match('/{"class":"POLL".+}/i', $this->read(2000), $matches)) {
				$this->log("No match for GPS data this time round. Not an error.", 0);
				return false;
			}
			$data = json_decode($matches[0], true);
			if (!is_array($data)) {
				$this->log("Failed to decode JSON, this could be bad", 5);
				return false;
			}
			// Store the value for cache like effect
			$this->data = &$data;
			return $this->data;
		}
	}
?>
