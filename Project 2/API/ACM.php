<?php

class API_ACM {
	private static $URL = "http://dl.acm.org/results.cfm?";

	public static function query($query) {
		if (!is_string($query) || !strlen($query))
			return array();

		$response = file_get_contents(API_ACM::$URL . "&query=" . $query);

		libxml_use_internal_errors(true);

		$document = new DOMDocument();
		$document->loadHTML($response);

		$xpath = new DOMXPath($document);

		$result = array();
		foreach ($xpath->query("//*[@id=\"results\"]/div[@class=\"details\"]") as $node) {
			$item = array();

			$title = $xpath->query(".//div[@class=\"title\"]/a", $node);
			if ($title && $title->length)
				$item["title"] = $title->item(0)->textContent;

			$authors = $xpath->query(".//div[@class=\"authors\"]/a", $node);
			if ($authors && $authors->length) {
				$item["authors"] = array();
				foreach ($authors as $author)
					array_push($item["authors"], $author->textContent);
			}

			$conference = $xpath->query(".//div[@class=\"source\"]/span[2]", $node);
			if ($conference && $conference->length)
				$item["conference"] = $conference->item(0)->textContent;

			$abstract = $xpath->query(".//div[@class=\"abstract\"]", $node);
			if ($abstract && $abstract->length)
				$item["abstract"] = trim($abstract->item(0)->textContent);

			$pdf = $xpath->query(".//div[@class=\"ft\"]/a", $node);
			if ($pdf && $pdf->length)
				$item["pdf"] = "http://dl.acm.org/" . $pdf->item(0)->getAttribute("href");

			array_push($result, $item);
		}
		return $result;
	}
}

?>

