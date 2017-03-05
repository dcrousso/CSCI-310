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

	public function testGetTrackSearchWithNonArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackSearchWithEmptyArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array());

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackSearchWithArrayOfSizeOneWithInvalidItemShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array(NULL));

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackSearchWithArrayOfSizeOneWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array(""));

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackSearchWithArrayOfSizeOneShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk"));

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertGreaterThan(0, count($result[0]));
		$this->assertCount(3, $result[0][0]);
		$this->assertGreaterThan(0, strlen($result[0][0]["artist_name"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_id"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_name"]));
	}

	public function testGetTrackSearchWithArrayOfSizeTwoWithOneBeingNonStringShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk", NULL));

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertGreaterThan(0, count($result[0]));
		$this->assertCount(3, $result[0][0]);
		$this->assertGreaterThan(0, strlen($result[0][0]["artist_name"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_id"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_name"]));
	}

	public function testGetTrackSearchWithArrayOfSizeTwoWithOneBeingEmptyShouldReturnArrayOfSizeOne() {
		$result = API::getTrackSearch(array("Daft Punk", ""));

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertGreaterThan(0, count($result[0]));
		$this->assertCount(3, $result[0][0]);
		$this->assertGreaterThan(0, strlen($result[0][0]["artist_name"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_id"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_name"]));
	}

	public function testGetTrackSearchWithArrayOfSizeTwoShouldReturnArrayOfSizeTwo() {
		$result = API::getTrackSearch(array("Daft Punk", "The Beatles"));

		$this->assertTrue(is_array($result));
		$this->assertCount(2, $result);
		$this->assertGreaterThan(0, count($result[0]));
		$this->assertCount(3, $result[0][0]);
		$this->assertGreaterThan(0, strlen($result[0][0]["artist_name"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_id"]));
		$this->assertGreaterThan(0, strlen($result[0][0]["track_name"]));
		$this->assertGreaterThan(0, count($result[1]));
		$this->assertCount(3, $result[1][0]);
		$this->assertGreaterThan(0, strlen($result[1][0]["artist_name"]));
		$this->assertGreaterThan(0, strlen($result[1][0]["track_id"]));
		$this->assertGreaterThan(0, strlen($result[1][0]["track_name"]));
	}

	// API::getTrackLyricsGet

	public function testGetTrackLyricsGetWithNonArrayShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackLyricsGetWithEmptyArrayShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(array());

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeOneWithInvalidItemShouldReturnEmptyArray() {
		$result = API::getTrackLyricsGet(array(NULL));

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetTrackLyricsGetWithArrayOfSizeOneShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array(31751188 /* Daft Punk - One More Time */));

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertCount(2, $result[0]);
		$this->assertGreaterThan(0, strlen($result[0]["lyrics"]));
		$this->assertGreaterThan(0, strlen($result[0]["script_tracking_url"]));
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoWithOneBeingNonIntShouldReturnArrayOfSizeOne() {
		$result = API::getTrackLyricsGet(array(31751188 /* Daft Punk - One More Time */, NULL));

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertCount(2, $result[0]);
		$this->assertGreaterThan(0, strlen($result[0]["lyrics"]));
		$this->assertGreaterThan(0, strlen($result[0]["script_tracking_url"]));
	}

	public function testGetTrackLyricsGetWithArrayOfSizeTwoShouldReturnArrayOfSizeTwo() {
		$result = API::getTrackLyricsGet(array(31751188 /* Daft Punk - One More Time */, 19859892 /* Daft Punk - Get Lucky */));

		$this->assertTrue(is_array($result));
		$this->assertCount(2, $result);
		$this->assertCount(2, $result[0]);
		$this->assertGreaterThan(0, strlen($result[0]["lyrics"]));
		$this->assertGreaterThan(0, strlen($result[0]["script_tracking_url"]));
		$this->assertCount(2, $result[1]);
		$this->assertGreaterThan(0, strlen($result[1]["lyrics"]));
		$this->assertGreaterThan(0, strlen($result[1]["script_tracking_url"]));
	}

	// API::getArtistSearch

	public function testGetArtistSearchWithNonStringShouldReturnEmptyArray() {
		$result = API::getArtistSearch(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetArtistSearchWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getArtistSearch("");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testGetArtistSearchWithValidStringShouldReturnValidArray() {
		$result = API::getArtistSearch("Daft Punk");

		$this->assertTrue(is_array($result));
		$this->assertGreaterThan(0, count($result));
	}
}
