<?php

require("vendor/autoload.php");

require_once("API/IEEE.php");

class API_IEEE_Test extends PHPUnit\Framework\TestCase {
	public static function setUpBeforeClass() {
		echo "=== API_IEEE ===" . "\n";
	}

	protected function setUp() {
		echo $this->getName();
	}

	protected function tearDown() {
		echo "\n";
	}

	public static function tearDownAfterClass() {
		echo "=== API_IEEE ===" . "\n\n";
	}

	// API_IEEE::queryText

	public function testQueryTextWithNonStringShouldReturnEmptyArray() {
		$result = API_IEEE::queryText(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryTextWithEmptyStringShouldReturnEmptyArray() {
		$result = API_IEEE::queryText("");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryTextWithInvalidStringShouldReturnEmptyArray() {
		$result = API_IEEE::queryText("abcdefghijklmnopqrstuvxwyz");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryTextWithValidStringShouldReturnValidArray() {
		$result = API_IEEE::queryText("PHP");

		$this->assertTrue(is_array($result));
		$this->assertGreaterThan(0, count($result));

		$this->assertGreaterThan(0, strlen($result[0]["title"]));

		$this->assertGreaterThan(0, count($result[0]["authors"]));
		$this->assertGreaterThan(0, strlen($result[0]["authors"][0]));

		$this->assertGreaterThan(0, strlen($result[0]["conference"]));

		$this->assertGreaterThan(0, strlen($result[0]["pdf"]));
	}

	public function testQueryTextWithValidStringAndNonIntegerCountShouldReturnEmptyArray() {
		$result = API_IEEE::queryText("PHP", NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryTextWithValidStringAndInvalidIntegerCountShouldReturnEmptyArray() {
		$result = API_IEEE::queryText("PHP", 0);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryTextWithValidStringAndValidIntegerCountShouldReturnValidArrayOfMaximumSizeCount() {
		$result = API_IEEE::queryText("PHP", 15);

		$this->assertTrue(is_array($result));
		$this->assertCount(15, $result);

		$this->assertGreaterThan(0, strlen($result[0]["title"]));

		$this->assertGreaterThan(0, count($result[0]["authors"]));
		$this->assertGreaterThan(0, strlen($result[0]["authors"][0]));

		$this->assertGreaterThan(0, strlen($result[0]["conference"]));

		$this->assertGreaterThan(0, strlen($result[0]["pdf"]));
	}
}
