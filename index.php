<?php
//
	require_once 'yandex.php';
	require_once 'parser.class.php';

	isset($_GET['q']) ? $test = new yandex($_GET['q'],2,5):$test = new yandex("jquery habrahabr",2,5);

	echo $test->getParseURL();
	echo "<br/><br/>";
	$test2 = new SEParser($test->getParseURL());

	//print_r ($test2->titles);
	$i=0;
	foreach ($test2->titles as $title) {
		echo '<a href='.$test2->urls[$i++].'>'.$title.'</a><br/>';
	}
	//print_r ($test2->urls);


?>