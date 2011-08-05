<?php
class searchResult {
    var $url = array();
    var $title = array();
    var $position = array();
    var $clear = array();
    private $current = 0;

    public function addItem($url, $title) {
        array_push($this->url, $url);
        array_push($this->title, $title);
        array_push($this->clear, parse_url($url, PHP_URL_HOST));
        array_push($this->position, $this->current);
        $this->current++;
    }

    public function getItems() {
        /*$result = array(
            $urls = array(),
            $titles = array(),
            $clearURLs = array(),
            $position = array()
        );
        $result['urls'] = $this->url;
        $result['titles'] = $this->title;
        $result['clearURLs'] = $this->clear;
        $result['position'] = $this->position;*/

        return $this;
    }
}

?>