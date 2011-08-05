<?php
class searchResult {
	private $url = array();
	private $title = array();
	private $position = array();

	public function addItem($url,$title/*,$position*/){
		array_push($this->url,$url);
		array_push($this->title,$title);
		//array_push($this->position,$position);
	}

}

?>