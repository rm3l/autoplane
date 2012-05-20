<?php
	class FileWriter {
		private $file = false;
		private $writer = false;
		private $log = false;
		private $mode = "a";

		function __construct ($file = false, $unique = false, $mode = false) {
			$this->log = new Log("File Writter");
			$this->setFile(&$file, &$unique);
			$this->setMode(&$mode);
		}

		public function setMode ($mode = false) {
			if (!is_string($mode)) {
				if ($mode !== false) {
					$this->log->log("Invalid datatype for mode", 1);
				}
				return false;
			}
			$this->log->log("Setting write mode to {$mode}", 0);
			$mode = strtolower($mode);
			$modes = array("r", "r+", "w", "w+", "a", "a+", "x", "x+", "c", "c+");
			if (!in_array($mode, $modes)) {
				$this->log->log("Mode unknown", 2);
				return false;
			}
			$this->mode = &$mode;
			return true;
		}

		public function setFile ($file = false, $unique = false) {
			if (!is_string($file)) {
				$this->log->log("File is not a string", 1);
				return false;
			}
			if (is_resource($this->writer)) {
				$this->log->log("Cannot set file whilst a file is already open", 3);
				return false;
			}
			$dir = dirname($file);
			if (!file_exists($dir)) {
				$this->log->log("Containing folder doesn't exist", 1);
				if (!mkdir($dir, 0770, true)) {
					$this->log->log("Failed to create parent folders", 2);
					return false;
				}
			}
			$this->log->log("Opening file {$file}", 0);
			if ($unique && file_exists($file)) {
				$parts = explode("/", $file);
				$file = array_pop($parts);
				$dir = implode("/", $parts)."/";
				$iii = 0;
				while (file_exists($dir.$iii.$file)) {
					$iii++;
				}
				$file = $dir.$iii.$file;
			}
			$this->file = &$file;
			return $this->file;
		}

		public function write ($data = false) {
			if (!is_string($data)) {
				$this->log->log("Data is not a string", 1);
				return false;
			}
			if (!is_string($this->file)) {
				$this->log->log("File is not set");
				return false;
			}
			if (!is_resource($this->writer)) {
				$this->writer = fopen($this->file, $this->mode);
			}
			if (!is_resource($this->writer)) {
				$this->log->log("Failed to open file", 2);
				return false;
			}
			return fwrite($this->writer, $data);
		}

		public function close () {
			if (!$this->__destruct()) {
				$this->log->log("Cannot close file when it is not open", 1);
				return false;
			}
			return true;
		}

		function __destruct () {
			if (!is_resource($this->writer)) {
				return false;
			}
			$this->log->log("Closing file: ".$this->file);
			return fclose($this->writer);
		}
	}
?>
