<?php
class yandex {
	private $URL = "http://yandex.ru/yandsearch?";
	const maxPages = 20;

	private $page = 0;

	private $localRegion = -1;
	private $query = '';
	private $depth;


	public function __construct($q, $lr = 2, $d = 1) {
		$this->query = $q;
		$this->localRegion = $lr;
		$this->depth = $d;
	}

	private function nextPage() {
		if ($this->page <= $this->depth) {
			$this->page++;
			return true;
		}
		else {
			return false;
		}
	}

	public function getParseURL() {
		return $this->URL.'text='.urlencode($this->query).'&lr='.$this->localRegion.'&p='.$this->page.'&numdoc=10';
	}


}

?>