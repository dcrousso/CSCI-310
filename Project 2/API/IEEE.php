<?php

class API_IEEE {
	private static $URL = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?";

	public static function queryText($query, $count = 10) {
		if (!is_string($query) || !strlen($query))
			return array();

		if (!is_numeric($count) || $count < 10)
			return array();

		$response = file_get_contents(API_IEEE::$URL . "&querytext=" . $query . "&hc=" . $count);

		$xml = simplexml_load_string($response, "SimpleXMLElement", LIBXML_NOCDATA);

		$json = json_decode(json_encode($xml), TRUE);
		if (!$json || !isset($json["document"]))
			return array();

		return array_map(function($item) {
			return array(
				"title"      => $item["title"],
				"authors"    => preg_split("/;\s*/", $item["authors"]),
				"conference" => $item["pubtitle"],
				"abstract"   => $item["abstract"],
				"pdf"        => $item["pdf"]
			);
		},  $json["document"]);
	}
}

?>

