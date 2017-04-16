<?php

require("vendor/autoload.php");

require_once("API/Util.php");

class API_Util_Test extends PHPUnit\Framework\TestCase {
	public static function setUpBeforeClass() {
		echo "=== API_Util ===" . "\n";
	}

	protected function setUp() {
		echo $this->getName();
	}

	protected function tearDown() {
		echo "\n";
	}

	public static function tearDownAfterClass() {
		echo "=== API_Util ===" . "\n\n";
	}

	// Util::splitWords

	public function testSplitWordsWithNonStringShouldReturnEmptyArray() {
		$result = Util::splitWords(NULL);

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

	// Util::getString

	public function testGetStringWithNonStringShouldReturnEmptyString() {
		$result = Util::getString(NULL);

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGetStringWithEmptyStringShouldReturnEmptyString() {
		$result = Util::getString("");

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGetStringWithInvalidStringShouldReturnEmptyString() {
		$result = Util::getString("test");

		$this->assertTrue(is_string($result));
		$this->assertEquals(0, strlen($result));
	}

	public function testGetStringWithValidStringShouldReturnValidString() {
		$result = Util::getString("https://cdn.paperpile.com/blog/files/Lander-1966.pdf");

		$this->assertTrue(is_string($result));
		$this->assertGreaterThan(0, strlen($result));
	}
}
