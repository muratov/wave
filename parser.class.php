<?php
include_once 'phpQuery-onefile.php';
	class SEParser {
		var $titles = array();
		var $urls = array();
		private $targetUrl;


		public function __construct($url) {
			/*			phpQuery::newDocumentFileHTML($url);
			   $results = pq('.b-serp-item');
			   foreach ($results as $li) {
				   array_push($this->titles, pq($li)->find('.b-serp-item__title-link')->text());
				   array_push($this->urls, pq($li)->find("a")->attr("href"));
			   }
   */
			$this->targetUrl = $url;
		}

		public function parsePage($resultClass, $hrefClass) {
			foreach ($this->targetUrl as $url) {
				phpQuery::newDocumentFileHTML($url);
				//$results = pq('.b-serp-item');
				$results = pq($resultClass);
				foreach ($results as $li) {
					//array_push($this->titles, pq($li)->find('.b-serp-item__title-link')->text());
					array_push($this->titles, pq($li)->find($hrefClass)->text());
					array_push($this->urls, pq($li)->find("a")->attr("href"));
				}
			}
		}

	}

?>