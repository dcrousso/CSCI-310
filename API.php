<?php

if ($_SERVER["SCRIPT_NAME"] === "/CSCI-310/API.php" && isset($_GET["a"]))
	echo json_encode(API::getArtistSearch($_GET["a"]));

class API {
	private static $KEY = "1f872ee1d20914aa4b34bdafa8f425c6";

	public static function getTrackSearch($artists) {
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
			$json = json_decode(curl_multi_getcontent($curl), TRUE)["message"]["body"];

			$result = array();
			foreach ($json["track_list"] as $item) {
				array_push($result, array(
					"artist_name" => $item["track"]["artist_name"],
					"track_id"    => $item["track"]["track_id"],
					"track_name"  => $item["track"]["track_name"]
				));
			}

			return $result;
		}, $curls);
	}

	public static function getTrackLyricsGet($trackIDs) {
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
			$json = json_decode(curl_multi_getcontent($curl), TRUE)["message"]["body"];

			$result = $json["lyrics"];
			return array(
				"lyrics"              => substr($result["lyrics_body"], 0, strpos($result["lyrics_body"], "\n...\n\n******* This Lyrics is NOT for Commercial use *******")),
				"script_tracking_url" => $result["script_tracking_url"]
			);
		}, $curls);
	}

	public static function getArtistSearch($artist) {
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/artist.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist));
		$json = json_decode($response, TRUE)["message"]["body"];

		$result = array();
		foreach ($json["artist_list"] as $item)
			array_push($result, $item["artist"]["artist_name"]);

		return $result;
	}
}

?>
