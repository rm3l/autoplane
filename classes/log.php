<?php
	class Log {
		private $messages = false;
		private $level = false;
		protected $iii = false;
		protected $process = 'Unknown';
		private $cli = true;

		function __construct ($process = false, $level = false) {
			$this->cli = php_sapi_name() == 'cli';
			if (!is_string($process)) {
				$process = implode(" ", $_SERVER['argv']);
			}
			if (!is_int($level)) {
				$level = 99;
			}
			$this->iii = 0;
			$this->process = $process;
			$this->level = $level;
			$this->messages = array();
			$this->log("Started Logging for: '{$process}'", 0);
			return true;
		}

		public function log ($msg = false, $level = 0) {
			if (!is_string($msg) || !is_int($level)) {
				return false;
			}
			$this->messages[$this->iii] = array(
					"message" => $msg,
					"level" => $level,
					"time" => microtime(true)
				);
			if ($level < $this->level) {
				$this->displayMessage($this->iii);
			}
			return $this->iii++;
		}

		public function displayMessage ($id = false) {
			if (!is_int($id) || !isset($this->messages[$id])) {
				return false;
			}
			$msg = &$this->messages[$id];
			if ($this->cli) {
				echo "[".$msg["time"]."]   \t".$msg["message"].PHP_EOL;
			} else {
				echo "<span class='time'>",$msg["time"],"</span>",
				     "<span class='message lvl",$msg["level"],"'>".$msg["message"]."</span>";
			}
			return true;
		}
	}
?>
