<?php

require("vendor/autoload.php");

require_once("Util.php");

class UtilTest extends PHPUnit\Framework\TestCase {
	// Util::splitWords

	public function testSplitWordsWithNULLShouldReturnEmptyArray() {
		$result = Util::splitWords(NULL);

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testSplitWordsWithNULLShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithNonStringShouldReturnEmptyArray() {
		$result = Util::splitWords(array());

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testSplitWordsWithNonStringShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithEmptyStringShouldReturnEmptyArray() {
		$result = Util::splitWords("");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testSplitWordsWithEmptyStringShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithValidStringOfOneWordShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 1);

		echo "testSplitWordsWithValidStringOfOneWordShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithValidStringOfOneWordTwiceShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo foo");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 2);

		echo "testSplitWordsWithValidStringOfOneWordTwiceShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithValidStringOfTwoWordsShouldReturnArrayOfSizeTwo() {
		$result = Util::splitWords("foo bar");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 2);
		$this->assertEquals($result["foo"], 1);
		$this->assertEquals($result["bar"], 1);

		echo "testSplitWordsWithValidStringOfTwoWordsShouldReturnArrayOfSizeTwo" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithValidStringOfOneIgnoredWordsShouldReturnEmptyArray() {
		$result = Util::splitWords("a");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 0);

		echo "testSplitWordsWithValidStringOfOneIgnoredWordsShouldReturnEmptyArray" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testSplitWordsWithValidStringOfOneWordAndOneIgnoredWordsShouldReturnArrayOfSizeOne() {
		$result = Util::splitWords("foo a");

		$this->assertTrue(is_array($result));
		$this->assertEquals(count($result), 1);
		$this->assertEquals($result["foo"], 1);

		echo "testSplitWordsWithValidStringOfOneWordAndOneIgnoredWordsShouldReturnArrayOfSizeOne" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	// Util::generateArtistsQuery

	public function testGenerateArtistsQueryWithNULLShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(NULL);

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);

		echo "testGenerateArtistsQueryWithNULLShouldReturnEmptyString" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGenerateArtistsQueryWithNonArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery("");

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);

		echo "testGenerateArtistsQueryWithNonArrayShouldReturnEmptyString" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGenerateArtistsQueryWithEmptyArrayShouldReturnEmptyString() {
		$result = Util::generateArtistsQuery(array());

		$this->assertTrue(is_string($result));
		$this->assertEquals(strlen($result), 0);

		echo "testGenerateArtistsQueryWithEmptyArrayShouldReturnEmptyString" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGenerateArtistsQueryWithArrayOfSizeOneShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo"));

		$this->assertTrue(is_string($result));
		$this->assertEquals($result, "a[]=foo");

		echo "testGenerateArtistsQueryWithArrayOfSizeOneShouldReturnValidString" . "\n";
		var_dump($result);
		echo "\n\n";
	}

	public function testGenerateArtistsQueryWithArrayOfSizeTwoShouldReturnValidString() {
		$result = Util::generateArtistsQuery(array("foo", "bar"));

		$this->assertTrue(is_string($result));
		$this->assertEquals($result, "a[]=foo&a[]=bar");

		echo "testGenerateArtistsQueryWithArrayOfSizeTwoShouldReturnValidString" . "\n";
		var_dump($result);
		echo "\n\n";
	}
}
