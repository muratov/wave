<?php
include_once 'phpQuery-onefile.php';
require_once 'searchResult.class.php';
class SEParser {
/*    var $titles = array();
    var $urls = array();
    var $clearURLs = array();*/
    private $targetUrl;


    public function __construct($url) {
        $this->targetUrl = $url;
    }

    public function parsePage($resultClass, $hrefClass, $captchaClass) {
        $searchResult = new searchResult();
        foreach ($this->targetUrl as $url) {
            phpQuery::newDocumentFileHTML($url);
            if (pq($captchaClass)->html()!='') {
                $searchResult = false;
            } else {

                $results = pq($resultClass);
                foreach ($results as $li) {
 /*                   array_push($this->titles, pq($li)->find($hrefClass)->text());
                    array_push($this->urls, pq($li)->find("a")->attr("href"));
 */

                    $searchResult->addItem(pq($li)->find("a")->attr("href"), pq($li)->find($hrefClass)->text());
                }
            }
        }
        return $searchResult;
    }

/*    public function getClearURLs() {
        //array_push($this->clearURLs, parse_url($this->urls, PHP_URL_HOST));
    }*/


}

?>