<?php
//
	require_once 'yandex.php';
	require_once 'parser.class.php';


	$test = new yandex("hello world",2,5);
	echo $test->getParseURL();
	$test2 = new SEParser($test->getParseURL());
	echo $test2->title;


?>