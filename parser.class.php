<?php
include_once 'phpQuery-onefile.php';
	class SEParser {
		var $titles = array();
		var $urls = array();


		public function __construct($url) {
			phpQuery::newDocumentFileHTML($url);
			$results = pq('.b-serp-item');
			foreach ($results as $li) {
				array_push($this->titles, pq($li)->find('.b-serp-item__title-link')->text());
				array_push($this->urls, pq($li)->find("a")->attr("href"));
			}

		}

	}

?>