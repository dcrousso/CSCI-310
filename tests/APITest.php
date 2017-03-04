<?php

require("vendor/autoload.php");

require_once("API.php");

class APITest extends PHPUnit\Framework\TestCase {
	// API::getTrackSearch

	public function testGetTrackSearchWithNULLShouldReturnEmptyArray() {
		$result = API::getTrackSearch(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testGetTrackSearchWithNULLShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGetTrackSearchWithNonArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testGetTrackSearchWithNonArrayShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGetTrackSearchWithEmptyArrayShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testGetTrackSearchWithEmptyArrayShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGetTrackSearchWithArrayOfSizeOneWithEmptyStringShouldReturnEmptyArray() {
		$result = API::getTrackSearch(array(""));

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testGetTrackSearchWithArrayOfSizeOneWithEmptyStringShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
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

		echo "testGetTrackSearchWithArrayOfSizeOneShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
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

		echo "testGetTrackSearchWithArrayOfSizeTwoWithOneBeingNULLShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
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

		echo "testGetTrackSearchWithArrayOfSizeTwoWithOneBeingNonStringShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
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

		echo "testGetTrackSearchWithArrayOfSizeTwoWithOneBeingEmptyShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
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

		echo "testGetTrackSearchWithArrayOfSizeTwoShouldReturnArrayOfSizeTwo" . "\n";
		var_dump($result);
		echo "\n\n";
	}
}
