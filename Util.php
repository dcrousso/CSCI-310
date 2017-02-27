<?php

class Util {

  public static function splitWords($string) {
    $words = array_filter(preg_split("/\W/", $string));
    $words = array_count_values($words);
    arsort($words);
    
    return $words;
  }
}

?>
