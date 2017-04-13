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
			$authors = $xpath->query(".//div[@class=\"authors\"]/a", $node);
			$conference = $xpath->query(".//div[@class=\"source\"]/span[2]", $node);
			$abstract = $xpath->query(".//div[@class=\"abstract\"]", $node);
			$pdf = $xpath->query(".//div[@class=\"ft\"]/a", $node);
			if (!$title->length || !$authors->length || !$conference->length || !$abstract->length || !$pdf->length)
				continue;

			$item["title"] = $title->item(0)->textContent;
			$item["authors"] = array();
			foreach ($authors as $author)
				array_push($item["authors"], $author->textContent);
			$item["conference"] = $conference->item(0)->textContent;
			$item["abstract"] = trim($abstract->item(0)->textContent);
			$item["pdf"] = "http://dl.acm.org/" . $pdf->item(0)->getAttribute("href");

			array_push($result, $item);
		}
		return $result;
	}
}

?>

