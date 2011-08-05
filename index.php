<?php
//
require_once 'yandex.php';
require_once 'nigma.php';
require_once 'parser.class.php';

/*isset($_GET['q']) ? $test = new yandex($_GET['q'], 2, 1) : $test = new yandex("jquery habrahabr", 2, 1);

    echo "<br/><br/>";
    $test2 = new SEParser($test->getParseURLs());

    if ($test2->parsePage('.b-serp-item','.b-serp-item__title-link','.b-captcha__layout')==false) {
        echo 'captcha';

    };*/

isset($_GET['q']) ? $test = new nigma($_GET['q'], 1) : $test = new nigma("jquery habrahabr", 1);
echo "<br/><br/>";

$test2 = new SEParser($test->getParseURLs());

/*if ($test2->parsePage('#results li','.snippet_title','.b-captcha__layout')==false) {
    echo 'captcha';

};*/

$i = 0;
print_r($test2->parsePage('#results li','.snippet_title','.b-captcha__layout')->getItems());
foreach ($test2->titles as $title) {
    echo '<a href=' . $test2->urls[$i] . '>' . $title . '</a> - ' . $test2->clearURLs[$i++] . '<br/>';
}


?>