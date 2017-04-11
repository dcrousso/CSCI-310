<?php

include("vendor/autoload.php");

class Util {
	public static function splitWords($string) {
		if (!is_string($string) || !strlen($string))
			return array();
		// lowercase all words in string, then split w RegEx, then filter out white spaces
		$words = array_filter(preg_split("/\W/", strtolower($string)), function($item) {
			if (!$item || strlen($item) < 3)
				return false;

			if (is_numeric($item))
				return false;

			return !in_array($item, array("i", "me", "my", "myself", "we", "our", "ours", "ourselves", "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself", "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their", "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these", "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has", "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if", "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about", "against", "between", "into", "through", "during", "before", "after", "above", "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under", "again", "further", "then", "once", "here", "there", "when", "where", "why", "how", "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no", "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can", "will", "just", "don", "should", "now"));
		});

		$words = array_count_values($words);

		arsort($words);

		return $words;
	}

	public static function getWords($url) {
		if (!is_string($url) || !strlen($url))
			return "";

		$parser = new \Smalot\PdfParser\Parser();
		$pdf = $parser->parseFile($url);
		return $pdf->getText();
	}
}
