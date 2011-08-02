<?php
//
	require_once 'yandex.php';
	require_once 'parser.class.php';

	isset($_GET['q']) ? $test = new yandex($_GET['q'], 2, 1) : $test = new yandex("jquery habrahabr", 2, 1);

	//print_r ($test->getParseURLs());
	echo "<br/><br/>";
	$test2 = new SEParser($test->getParseURLs());
	$test2->parsePage('.b-serp-item','.b-serp-item__title-link');


	$i=0;
	 foreach ($test2->titles as $title) {
		 echo '<a href='.$test2->urls[$i++].'>'.$title.'</a><br/>';
	 }


?>