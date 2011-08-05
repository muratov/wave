<?php

define('RESULTSPERPAGE', 10);
define('MAXPAGES', 20);
class yandex {
    private $URL = "http://yandex.ru/yandsearch?";
    var $resultClass = '.b-serp-item';
    var $hrefClass = '.b-serp-item__title-link';
    var $captchClass = '.b-captcha__layout';


    private $page = 0;

    private $localRegion = -1;
    private $query = '';
    private $depth;
    private $URLsArray = array();

    public function __construct($q, $lr = 2, $d = 1) {
        $this->query = $q;
        $this->localRegion = $lr;
        $this->depth = $d;
    }

    public function getParseURLs($start=0) {

        for ($i = $start; $i < $this->depth; $i++) {
            array_push($this->URLsArray, $this->URL . 'text=' . urlencode($this->query) . '&lr=' . $this->localRegion . '&p=' . $i . '&numdoc=' . RESULTSPERPAGE);
        }
        return $this->URLsArray;
    }


}

?>