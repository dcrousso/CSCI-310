<?php

if ($_SERVER["SCRIPT_NAME"] === "/CSCI-310/API.php" && isset($_GET["a"]))
	echo json_encode(API::getArtistSearch($_GET["a"]));

class API {
	private static $KEY = "1f872ee1d20914aa4b34bdafa8f425c6";

	public static function getTrackSearch($artists) {
		if (!isset($artists) || !is_array($artists) || !count($artists))
			return array();

		$multi = curl_multi_init();

		$curls = array_map(function($artist) use (&$multi) {
			$curl = curl_init("https://api.musixmatch.com/ws/1.1/track.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist));
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

			curl_multi_add_handle($multi, $curl);

			return $curl;
		}, $artists);

		$running = null;
		do {
			curl_multi_exec($multi, $running);
		} while ($running);

		foreach ($curls as $curl)
			curl_multi_remove_handle($multi, $curl);

		curl_multi_close($multi);

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

	public static function getTrackLyricsGet($trackIDs) {
		if (!isset($trackIDs) || !is_array($trackIDs) || !count($trackIDs))
			return array();

		$multi = curl_multi_init();

		$curls = array_map(function($trackID) use (&$multi) {
			$curl = curl_init("https://api.musixmatch.com/ws/1.1/track.lyrics.get?apikey=" . API::$KEY . "&track_id=" . $trackID);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

			curl_multi_add_handle($multi, $curl);

			return $curl;
		}, $trackIDs);

		$running = null;
		do {
			curl_multi_exec($multi, $running);
		} while ($running);

		foreach ($curls as $curl)
			curl_multi_remove_handle($multi, $curl);

		curl_multi_close($multi);

		return array_map(function($curl) {
			$json = json_decode(curl_multi_getcontent($curl), TRUE)["message"]["body"]["lyrics"];
			return array(
				"lyrics"              => substr($json["lyrics_body"], 0, strpos($json["lyrics_body"], "\n...\n\n******* This Lyrics is NOT for Commercial use *******")),
				"script_tracking_url" => $json["script_tracking_url"]
			);
		}, $curls);
	}

	public static function getArtistSearch($artist) {
		if (!isset($artist) || !is_string($artist))
			return array();

		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/artist.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist));
		$json = json_decode($response, TRUE)["message"]["body"]["artist_list"];
		return array_map(function($artist) {
			return $artist["artist"]["artist_name"];
		}, $json);
	}
}

?>
