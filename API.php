<?php

class API {
	private static $KEY = "1f872ee1d20914aa4b34bdafa8f425c6";

	public static function getTrackSearch($artist) {
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/track.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist) . "&page_size=100");
		$json = json_decode($response, true)["message"]["body"];

		$result = array();
		foreach ($json["track_list"] as $item) {
			array_push($result, array(
				"artist_name" => $item["track"]["artist_name"],
				"track_id"    => $item["track"]["track_id"],
				"track_name"  => $item["track"]["track_name"]
			));
		}

		return $result;
	}

	public static function getTrackLyricsGet($trackID) {
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/track.lyrics.get?apikey=" . API::$KEY . "&track_id=" . $trackID);
		$json = json_decode($response, true)["message"]["body"];

		$lyrics = $json["lyrics"]["lyrics_body"];
		return substr($lyrics, 0, strpos($lyrics, "\n\n...\n\n******* This Lyrics is NOT for Commercial use *******"));
	}

	public static function getArtistSearch($artist) {
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/artist.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist) . "&page_size=100");
		$json = json_decode($response, true)["message"]["body"];

		$result = array();
		foreach ($json["artist_list"] as $item)
			array_push($result, $item["artist"]["artist_name"]);

		return $result;
	}
}

?>
