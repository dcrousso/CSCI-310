<?php

require_once("Util.php");

class API {
	private static $KEY = "1f872ee1d20914aa4b34bdafa8f425c6";

	public static function getTrackSearch($artist) {
		$response = file_get_contents("https://api.musixmatch.com/ws/1.1/track.search?apikey=" . API::$KEY . "&q_artist=" . urlencode($artist) . "&page_size=100");
		$json = json_decode($response, true)["message"]["body"]["track_list"];
		return $json;

		$result = array();
		foreach ($json as $item) {
			array_push($result, array(
				"artist_name" => $item["track"]["artist_name"],
				"track_id"    => $item["track"]["track_id"],
				"track_name"  => $item["track"]["track_name"]
			));
		}

		return $result;
	}

	public static function getTrackLyricsGet($trackID) {

	}

	public static function getArtistSearch($artist) {

	}
}

?>
