<?php

	define('MAXPAGES', 20);
	class nigma {
		private $URL = "http://nigma.ru/?";
        var $resultClass = '#results li';
        var $hrefClass = '.snippet_title';
        var $captchClass = '.b-captcha__layout';
        
		private $page = 0;

		private $query = '';
		private $depth;
		private $URLsArray=array();

		public function __construct($s,$d) {
			$this->query = $s;
			$this->depth = $d;
		}

    	public function getParseURLs() {

			for ($i = 0; $i < $this->depth; $i++) {
				array_push($this->URLsArray, $this->URL.'s='. urlencode($this->query).'&startpos='.($i*10));
			}
			return $this->URLsArray;
		}


	}

?>