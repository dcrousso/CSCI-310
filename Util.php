<?php

class Util {
	/*
	 * @param $string : the string input string to split
	 * splitWords($string)
	 *
	 * Explodes $string and reformats/counts words to return a map of words to frequencies
	 */
	public static function splitWords($string) {
		if (!is_string($string))
			return array();

		// lowercase all words in string, then split w RegEx, then filter out white spaces
		$words = array_filter(preg_split("/\W/", strtolower($string)), function($item) {
			if (!$item || !strlen($item))
				return false;

			// NLTK's list of english stopwords (https://gist.github.com/sebleier/554280)
			return !in_array($item, array("i", "me", "my", "myself", "we", "our", "ours", "ourselves", "you", "your", "yours", "yourself", "yourselves", "he", "him", "his", "himself", "she", "her", "hers", "herself", "it", "its", "itself", "they", "them", "their", "theirs", "themselves", "what", "which", "who", "whom", "this", "that", "these", "those", "am", "is", "are", "was", "were", "be", "been", "being", "have", "has", "had", "having", "do", "does", "did", "doing", "a", "an", "the", "and", "but", "if", "or", "because", "as", "until", "while", "of", "at", "by", "for", "with", "about", "against", "between", "into", "through", "during", "before", "after", "above", "below", "to", "from", "up", "down", "in", "out", "on", "off", "over", "under", "again", "further", "then", "once", "here", "there", "when", "where", "why", "how", "all", "any", "both", "each", "few", "more", "most", "other", "some", "such", "no", "nor", "not", "only", "own", "same", "so", "than", "too", "very", "s", "t", "can", "will", "just", "don", "should", "now"));
		});

		// count the number of occurrences
		$words = array_count_values($words);

		// sort the words into an array and return
		arsort($words);
		return $words;
	}

	/*
	 * @param $artists : the artists in a search query
	 * generateArtistsQuery($artists)
	 *
	 * Takes all the artists a user might search for and generates a query string for it
	 */
	public static function generateArtistsQuery($artists) {
		if (!is_array($artists) || !count($artists))
			return "";

		return "a[]=" . implode("&a[]=", $artists);
	}
}

?>
