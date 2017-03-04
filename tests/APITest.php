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
}
