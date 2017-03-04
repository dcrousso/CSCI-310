<?php

require("vendor/autoload.php");

require_once("Util.php");

class UtilTest extends PHPUnit\Framework\TestCase {
	// Util::splitWords

	public function testSplitWordsWithNULLShouldReturnEmptyArray() {
		$result = Util::splitWords(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testSplitWordsWithNonStringShouldReturnEmptyArray() {
		$result = Util::splitWords(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testSplitWordsWithEmptyStringShouldReturnEmptyArray() {
		$result = Util::splitWords("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testSplitWordsWithValidStringOfOneWordShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 1);
	}

	public function testSplitWordsWithValidStringOfOneWordTwiceShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo foo");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 2);
	}

	public function testSplitWordsWithValidStringOfTwoWordsShouldReturnArrayOfSizeTwo() {
		$result = Util::splitWords("foo bar");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 2);
		$this->assertEquals($result["foo"], 1);
		$this->assertEquals($result["bar"], 1);
	}

	public function testSplitWordsWithValidStringOfOneIgnoredWordsShouldReturnEmptyArray() {
		$result = Util::splitWords("a");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);
	}

	public function testSplitWordsWithValidStringOfOneWordAndOneIgnoredWordsShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo a");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 1);
	}

	// Util::generateArtistsQuery

	public function testGenerateArtistsQueryWithNULLShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(NULL);

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);
	}

	public function testGenerateArtistsQueryWithNonArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery("");

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);
	}

	public function testGenerateArtistsQueryWithEmptyArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(array());

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);
	}

	public function testGenerateArtistsQueryWithArrayOfSizeOneShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo"));

		$this->assertTrue(is_string($result));
		$this->assertEquals($result, "a[]=foo");
	}

	public function testGenerateArtistsQueryWithArrayOfSizeTwoShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo", "bar"));

		$this->assertTrue(is_string($result));
		$this->assertEquals($result, "a[]=foo&a[]=bar");
	}
}
