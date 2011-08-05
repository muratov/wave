<?php
//
	require_once 'yandex.php';
	require_once 'nigma.php';
	require_once 'parser.class.php';

	isset($_GET['q']) ? $yandexQuest = new yandex($_GET['q'], 1) : $yandexQuest = new yandex("jquery habrahabr", 1);
	echo "<br/><br/>";

	$yandexParser = new SEParser($yandexQuest->getParseURLs());
	$test = $yandexParser->parsePage($yandexQuest->resultClass, $yandexQuest->hrefClass, $yandexQuest->captchClass);
	if ($test == false) {
		echo 'captcha';
	} else {
		echo "<br/><br/>";
		$i = 0;
		$yandexResults = $test->getItems();

		foreach ($yandexResults->title as $title) {
			echo $yandexResults->position[$i] . ' <a href=' . $yandexResults->url[$i] . '>' . $title . '</a> - ' . $yandexResults->clear[$i++] . '<br/>';
		}
	}


	echo "<br/><br/>";
	echo "<br/><br/>";
	echo "<br/><br/>";

	isset($_GET['q']) ? $nigmaQuest = new nigma($_GET['q'], 1) : $nigmaQuest = new nigma("jquery habrahabr", 1);
	echo "<br/><br/>";

	$nigmaParser = new SEParser($nigmaQuest->getParseURLs());
	$test2 = $nigmaParser->parsePage($nigmaQuest->resultClass, $nigmaQuest->hrefClass, $nigmaQuest->captchClass);
	if ($test2 == false) {
		echo 'captcha';
	} else {
		echo "<br/><br/>";
		$i = 0;
		$nigmaResults = $test2->getItems();

		foreach ($nigmaResults->title as $title) {
			echo $nigmaResults->position[$i] . ' <a href=' . $nigmaResults->url[$i] . '>' . $title . '</a> - ' . $nigmaResults->clear[$i++] . '<br/>';
		}
	}


?>