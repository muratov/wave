<?php
include_once 'phpQuery-onefile.php';
require_once 'searchResult.class.php';
class SEParser {
    private $targetUrl;
    var $stopPage = 0;


    public function __construct($url) {
        $this->targetUrl = $url;
    }

    public function parsePage($resultClass, $hrefClass, $captchaClass) {
        $searchResult = new searchResult();
        foreach ($this->targetUrl as $url) {
            phpQuery::newDocumentFileHTML($url);
            if (pq($captchaClass)->html() != '') {
                $searchResult = false;
            } else {

                $results = pq($resultClass);
                foreach ($results as $li) {
                    $searchResult->addItem(pq($li)->find("a")->attr("href"), pq($li)->find($hrefClass)->text());
                }
                $this->stopPage++;
            }
        }

        return $searchResult;

    }

    public function isSuccess() {
        if (count($this->targetUrl) == $this->stopPage) {
            return true;
        } else {
            return false;
        }

    }

}

?>