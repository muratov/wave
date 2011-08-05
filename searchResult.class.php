<?php
class searchResult {
	var $url = array();
	var $title = array();
	var $position = array();
	var $clear = array();
	private $current = 1;

	public function addItem($url, $title) {
		array_push($this->url, $url);
		array_push($this->title, $title);
		array_push($this->clear, parse_url($url, PHP_URL_HOST));
		array_push($this->position, $this->current);
		$this->current++;
	}

	public function getItems() {
		return $this;
	}
}

?>