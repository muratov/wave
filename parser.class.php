<?php
include_once 'phpQuery-onefile.php';
	class SEParser {
		var $titles = array();
		var $urls = array();
		var $clearURLs = array();
		private $targetUrl;


		public function __construct($url) {
			$this->targetUrl = $url;
		}

		public function parsePage($resultClass, $hrefClass) {
			foreach ($this->targetUrl as $url) {
				phpQuery::newDocumentFileHTML($url);
				//$results = pq('.b-serp-item');
				if (pq('.b-captcha__layout')) {
					echo '<img src="' . pq('.b-captcha__layout img')->attr('src') . '"/>';
				}

				$results = pq($resultClass);
				foreach ($results as $li) {
					array_push($this->titles, pq($li)->find($hrefClass)->text());
					array_push($this->urls, pq($li)->find("a")->attr("href"));
				}
			}
		}

		public function getClearURLs() {
			array_push($this->clearURLs, parse_url($this->urls, PHP_URL_HOST));
		}


	}

?>