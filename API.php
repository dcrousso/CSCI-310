<?php

// Check for script presence and if query parameter a is set
if ($_SERVER["SCRIPT_NAME"] === "/CSCI-310/API.php" && isset($_GET["a"]))
	echo json_encode(API::getArtistSearch($_GET["a"]));


// API Class
class API {

  // MusixMatch API Key
	private static $KEY = "1f872ee1d20914aa4b34bdafa8f425c6";

  /*
   * @param $artists : an array of all artists queried for song names
   * getTrackSearch($artists)
   *
   * Takes an array of artists and obtains their discographies from MusixMatch
   */
  public static function getTrackSearch($artists) {
    // Input Validation
		if (!isset($artists) || !is_array($artists) || !count($artists))
			return array();

    // Utilizing multi-curl requests for (essentially) async requests
		$multi = curl_multi_init();

    $curls = array_map(function($artist) use (&$multi) {
      // Create a curl request for each artist
			$curl = curl_init("https://api.musixmatch.com/ws/1.1/track.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

      // Add curl request to $multi curl_multi handler
			curl_multi_add_handle($multi, $curl);

			return $curl;
		}, $artists);

    // do while loop to execute multi-curl till completion
		$running = null;
		do {
			curl_multi_exec($multi, $running);
		} while ($running);

    // post-multicurl cleanup
		foreach ($curls as $curl)
			curl_multi_remove_handle($multi, $curl);

		curl_multi_close($multi);

    // return the data retrieved from multi-curl requests
		return array_map(function($curl) {
			$json = json_decode(curl_multi_getcontent($curl), TRUE)["message"]["body"]["track_list"];
			return array_map(function($track) {
				return array(
					"artist_name" => $track["track"]["artist_name"],
					"track_id"    => $track["track"]["track_id"],
					"track_name"  => $track["track"]["track_name"]
				);
			}, $json);
		}, $curls);
	}

  /*
   * @param $trackIDs : an array of trackIDs
   * getTrackLyricsGet($trackIDs)
   *
   * Takes an array of trackIDs and returns their corresponding lyrics as an array_map
   */
  public static function getTrackLyricsGet($trackIDs) {
    // Validate input
		if (!isset($trackIDs) || !is_array($trackIDs) || !count($trackIDs))
			return array();

    // multi-curl request for async requests
		$multi = curl_multi_init();

    // store curls as an array_map of all individual curl requests
		$curls = array_map(function($trackID) use (&$multi) {
			$curl = curl_init("https://api.musixmatch.com/ws/1.1/track.lyrics.get?apikey=" . API::$KEY . "&track_id=" . $trackID);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

			curl_multi_add_handle($multi, $curl);

			return $curl;
		}, $trackIDs);

    // do while loop to execute while running
		$running = null;
		do {
			curl_multi_exec($multi, $running);
		} while ($running);

    // post-multicurl cleanup
		foreach ($curls as $curl)
			curl_multi_remove_handle($multi, $curl);

		curl_multi_close($multi);

    // return an array map of lyrics and script_tracking_urls
		return array_map(function($curl) {
			$json = json_decode(curl_multi_getcontent($curl), TRUE)["message"]["body"]["lyrics"];
			return array(
				"lyrics"              => substr($json["lyrics_body"], 0, strpos($json["lyrics_body"], "\n...\n\n******* This Lyrics is NOT for Commercial use *******")),
				"script_tracking_url" => $json["script_tracking_url"]
			);
		}, $curls);
	}

  /*
   * @param $artist: the name of the artist being searched for
   * getArtistSearch($artist)
   *
   * Takes in an artist name query as input and returns an array of possible artists that would match that query
   */
	public static function getArtistSearch($artist) {
    // Validate input
    if (!isset($artist) || !is_string($artist))
			return array();

    // obtain the results of an api request and store it in response, return as a json
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/artist.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist));
		$json = json_decode($response, TRUE)["message"]["body"]["artist_list"];
		return array_map(function($artist) {
			return $artist["artist"]["artist_name"];
		}, $json);
	}
}

?>
