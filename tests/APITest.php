<?php

require("vendor/autoload.php");

require_once("API.php");

class APITest extends PHPUnit\Framework\TestCase {
	public static function setUpBeforeClass() {
		echo "=== APITest ===" . "\n";
	}

	protected function setUp() {
		echo $this->getName();
	}

	protected function tearDown() {
		echo "\n";
	}

	public static function tearDownAfterClass() {
		echo "=== APITest ===" . "\n\n";
	}

	// API::getTrackSearch

	public function testGetTrackSearchWithNULLShouldReturnEmptyArray() {
		$result = API::getTrackSearch(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackSearchWithNonArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackSearchWithEmptyArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackSearchWithArrayOfSizeOneWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array(""));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackSearchWithArrayOfSizeOneShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk"));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertTrue(count($result[0]) > 0);
		$this->assertEquals(count($result[0][0]), 3);
		$this->assertTrue(strlen($result[0][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_name"]) > 0);
	}

	public function testGetTrackSearchWithArrayOfSizeTwoWithOneBeingNULLShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk", NULL));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertTrue(count($result[0]) > 0);
		$this->assertEquals(count($result[0][0]), 3);
		$this->assertTrue(strlen($result[0][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_name"]) > 0);
	}

	public function testGetTrackSearchWithArrayOfSizeTwoWithOneBeingNonStringShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk", array()));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertTrue(count($result[0]) > 0);
		$this->assertEquals(count($result[0][0]), 3);
		$this->assertTrue(strlen($result[0][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_name"]) > 0);
	}

	public function testGetTrackSearchWithArrayOfSizeTwoWithOneBeingEmptyShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk", ""));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertTrue(count($result[0]) > 0);
		$this->assertEquals(count($result[0][0]), 3);
		$this->assertTrue(strlen($result[0][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_name"]) > 0);
	}

	public function testGetTrackSearchWithArrayOfSizeTwoShouldReturnArrayOfSizeTwo() {
		$result = API::getTrackSearch(array("Daft Punk", "The Beatles"));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 2);
		$this->assertTrue(count($result[0]) > 0);
		$this->assertEquals(count($result[0][0]), 3);
		$this->assertTrue(strlen($result[0][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[0][0]["track_name"]) > 0);
		$this->assertTrue(count($result[1]) > 0);
		$this->assertEquals(count($result[1][0]), 3);
		$this->assertTrue(strlen($result[1][0]["artist_name"]) > 0);
		$this->assertTrue(strlen($result[1][0]["track_id"]) > 0);
		$this->assertTrue(strlen($result[1][0]["track_name"]) > 0);
	}

	// API::getTrackLyricsGet

	public function testGetTrackLyricsGetWithNULLShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackLyricsGetWithNonArrayShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackLyricsGetWithEmptyArrayShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeOneWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(array(""));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeOneShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array("31751188" /* One More Time */));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals(count($result[0]), 2);
		$this->assertTrue(strlen($result[0]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[0]["script_tracking_url"]) > 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoWithOneBeingNULLShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array("31751188" /* One More Time */, NULL));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals(count($result[0]), 2);
		$this->assertTrue(strlen($result[0]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[0]["script_tracking_url"]) > 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoWithOneBeingNonStringShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array("31751188" /* One More Time */, array()));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals(count($result[0]), 2);
		$this->assertTrue(strlen($result[0]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[0]["script_tracking_url"]) > 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoWithOneBeingEmptyShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array("31751188" /* One More Time */, ""));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals(count($result[0]), 2);
		$this->assertTrue(strlen($result[0]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[0]["script_tracking_url"]) > 0);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoShouldReturnArrayOfSizeTwo() {
		$result = API::getTrackLyricsGet(array("31751188" /* One More Time */, "19859892" /* Get Lucky */));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 2);
		$this->assertEquals(count($result[0]), 2);
		$this->assertTrue(strlen($result[0]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[0]["script_tracking_url"]) > 0);
		$this->assertEquals(count($result[1]), 2);
		$this->assertTrue(strlen($result[1]["lyrics"]) > 0);
		$this->assertTrue(strlen($result[1]["script_tracking_url"]) > 0);
	}

	// API::getArtistSearch

	public function testGetArtistSearchWithNULLShouldReturnEmptyArray() {
		$result = API::getArtistSearch(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetArtistSearchWithNonStringShouldReturnEmptyArray() {
		$result = API::getArtistSearch(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetArtistSearchWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getArtistSearch("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testGetArtistSearchWithValidStringShouldReturnValidArray() {
		$result = API::getArtistSearch("Daft Punk");

		$this->assertTrue(is_array($result));
		$this->assertTrue(count($result) > 0);
	}
}
