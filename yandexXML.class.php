<?php
include_once 'phpQuery-onefile.php';
require_once 'searchResult.class.php';
class SEParser {
    var $titles = array();
    var $urls = array();
    var $clearURLs = array();
    private $targetUrl;


    public function __construct($url) {
        $this->targetUrl = $url;
    }

    public function parsePage() {
        
    }

    public function getClearURLs() {
        array_push($this->clearURLs, parse_url($this->urls, PHP_URL_HOST));
    }


}

?>