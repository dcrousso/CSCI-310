<?php

class Util {
  /*
   * @param $string : the string input string to split
   * splitWords($string)
   *
   * Explodes $string and reformats/counts words to return a map of words to frequencies
   */
  public static function splitWords($string) {
    // lowercase all words in string, then split w RegEx, then filter out white spaces
    $words = array_filter(preg_split("/\W/", strtolower($string)));

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
		return "a[]=" . implode("&a[]=", $artists);
	}
}

?>
