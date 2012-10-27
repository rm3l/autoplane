<?php
	// TODO: Build the rest of the class
	// Controls connections to server for sending and recieving of messages
	class CommandAndControl extends Log {
		private $url = false;
		function __construct ($url = false) {
			parent::__construct("C&C");
			$this->log("Creating new Command and Control Center", 0);
			$this->setUrl($url);
			return true;
		}

		public function setUrl ($url = false) {
			if(!preg_match("|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i", $url)) {
				if ($url) {
					$this->log("Url is not valid", 0);
				}
				return false;
			}
			$this->url = &$url;
			return true;
		}

		public function send () {
			// Fill me with instuctions
		}

		public function recieve () {
			// Fill me with instuctions
		}
	}
?>
