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

    public function getItems(){
        $result = array(
            $urls=array(),
            $titles = array()
        );
        $result['urls']=$this->url;
        $result['titles']=$this->title;
        return $result;
    }
}

?>