<?php
include_once 'phpQuery-onefile.php';
	class SEParser {
		var $title;
		var $titleElement;

		public function __construct($url) {

			phpQuery::newDocumentFileHTML($url);
			$this->title = pq('title')->html();
			//$this->title = $this->titleElement;
			$this->title;

		}

	}

?>