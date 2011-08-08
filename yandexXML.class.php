<?php

	// Для запуска требуется PHP 5
	header("Content-Type: text/html;charset=utf-8");


	include "template_header.html";

	// обработка полей формы
	$host = array_key_exists('host', $_REQUEST) ? $_REQUEST['host'] : 'www.yandex.ru';

	$query = array_key_exists('query', $_REQUEST) ? $_REQUEST['query'] : '';


	$esc = htmlspecialchars($query);
	$ehost = htmlspecialchars($host);

	$search_tail = htmlspecialchars(" host:$ehost");


	if ($_SERVER["REQUEST_METHOD"] == 'GET') {
		$page = array_key_exists('page', $_GET) ? $_GET['page'] : 0;

	} else $page = 0;

	$found = 0;
	$pages = 10;


?>

<form method='POST' accept-charset='utf-8'>
	<table width='100%'>
		<tr>
			<td width="16\%"/>

			<table>

				<tr>
					<td><label for='host'>Поиск по сайту: </label></td>
					<td><input type='text' name='host' id='host' value='<?php print $host ?>'/></td>

				</tr>
				<tr>
					<td><label for='query'>Запрос: </label></td>
					<td><input type='text' name='query' id='query' value='<?php print $query ?>'/></td>

				</tr>
				<tr>
					<td/>
					<td><input type="submit" value="Искать"/></td>

				</tr>
			</table>
			</td>
			<td width="9\%">
		</tr>
	</table>

</form>

<table width='100%'>
	<tr>
		<td width='16%'/>
		<td>

<?php

	if ($query) {


		// XML запрос
		$doc = <<<DOC
<?xml version='1.0' encoding='utf-8'?>
<request>
    <query>$query</query>

    <page>$page</page>
</request>
DOC;

		$context = stream_context_create(array(

											  'http' => array(
												  'method' => "POST",
												  'header' => "Content-type: application/xml\r\n" .
															  "Content-length: " . strlen($doc),
												  'content' => $doc

											  )
										 ));

		$response = file_get_contents('http://xmlsearch.yandex.ru/xmlsearch?user=for-xml-games&key=03.97744150:aef43f4caddbb7874f3f626af7351497', true, $context);
		if ($response) {


			$xmldoc = new SimpleXMLElement($response);

			$error = $xmldoc->response->error;
			$found_all = $xmldoc->response->found;
			$found = $xmldoc->xpath("response/results/grouping/group/doc");

			if ($error) {

				print "Ошибка: " . $error[0];
			} else {

				print "<p style='font-size: 80%'>Результат поиска: страниц — <b>$found_all</b></p><br/>\n";
				print "<ol start='" . ($page * 10 + 1) . "'>\n";
				foreach ($found as $item) {

					print "<li>";
					print "<a href='{$item->url}'>" . highlight_words($item->title) . "</a><br/>\n";

					print "<ul>";
					if ($item->passages) {

						foreach ($item->passages->passage as $passage) {

							print "<li style='font-size: 80%'>" . highlight_words($passage) . "</li><br/>\n";
						}

					}
					print "<span style='color: gray; font-size: 80%'>{$item->url}</span>";
					print "</ul></li><br/>\n";

				}


				print "</ol>\n";
				print_pager($found_all, $query, $host, $page);
			}

		} else {
			print "Внутренняя ошибка сервера.\n";
		}

	}

	print "</td></tr></table>";

	include "template_footer.html";

	function highlight_words($node) {
		$stripped = preg_replace('/<\/?(title|passage)[^>]*>/', '', $node->asXML());
		return str_replace('</hlword>', '</strong>', preg_replace('/<hlword[^>]*>/', '<strong>', $stripped));

	}

	function print_pager($found_links, $query, $host, $page = 0, $links_on_page = 10) {
		$query = htmlspecialchars($query);
		$host = htmlspecialchars($host);
		if ($page != 0)
			print "<a href='?page=" . ($page - 1) . "&query={$query}&host={$host}'>&#8592; предыдущая</a> ";
		print " страница № " . ($page + 1);

		if ($found_links > ($page + 1) * $links_on_page)
			print " <a href='?page=" . ($page + 1) . "&query=$query&host={$host}'>следующая &#8594;</a> ";

	}

	?>
