<?php

require("vendor/autoload.php");

require_once("Util.php");

class UtilTest extends PHPUnit\Framework\TestCase {
	public static function setUpBeforeClass() {
		echo "=== UtilTest ===" . "\n";
	}

	protected function setUp() {
		echo $this->getName();
	}

	protected function tearDown() {
		echo "\n";
	}

	public static function tearDownAfterClass() {
		echo "=== UtilTest ===" . "\n\n";
	}

	// Util::splitWords

	public function testSplitWordsWithNULLShouldReturnEmptyArray() {
		$result = Util::splitWords(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testSplitWordsWithNonStringShouldReturnEmptyArray() {
		$result = Util::splitWords(array());

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testSplitWordsWithEmptyStringShouldReturnEmptyArray() {
		$result = Util::splitWords("");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testSplitWordsWithValidStringOfOneWordShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo");

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertEquals(1, $result["foo"]);
	}

	public function testSplitWordsWithValidStringOfOneWordTwiceShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo foo");

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertEquals(2, $result["foo"]);
	}

	public function testSplitWordsWithValidStringOfTwoWordsShouldReturnArrayOfSizeTwo() {
		$result = Util::splitWords("foo bar");

		$this->assertTrue(is_array($result));
		$this->assertCount(2, $result);
		$this->assertEquals(1, $result["foo"]);
		$this->assertEquals(1, $result["bar"]);
	}

	public function testSplitWordsWithValidStringOfOneIgnoredWordsShouldReturnEmptyArray() {
		$result = Util::splitWords("a");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testSplitWordsWithValidStringOfOneWordAndOneIgnoredWordsShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo a");

		$this->assertTrue(is_array($result));
		$this->assertCount(1, $result);
		$this->assertEquals(1, $result["foo"]);
	}

	// Util::generateArtistsQuery

	public function testGenerateArtistsQueryWithNULLShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(NULL);

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGenerateArtistsQueryWithNonArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery("");

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGenerateArtistsQueryWithEmptyArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(array());

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGenerateArtistsQueryWithArrayOfSizeOneShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo"));

		$this->assertTrue(is_string($result));
		$this->assertEquals("a[]=foo", $result);
	}

	public function testGenerateArtistsQueryWithArrayOfSizeTwoShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo", "bar"));

		$this->assertTrue(is_string($result));
		$this->assertEquals("a[]=foo&a[]=bar", $result);
	}
}
