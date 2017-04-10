<?php

require("vendor/autoload.php");

require_once("API/ACM.php");

class API_ACM_Test extends PHPUnit\Framework\TestCase {
	public static function setUpBeforeClass() {
		echo "=== API_ACM ===" . "\n";
	}

	protected function setUp() {
		echo $this->getName();
	}

	protected function tearDown() {
		echo "\n";
	}

	public static function tearDownAfterClass() {
		echo "=== API_ACM ===" . "\n\n";
	}

	// API_ACM::query

	public function testQueryWithNonStringShouldReturnEmptyArray() {
		$result = API_ACM::query(NULL);

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryWithEmptyStringShouldReturnEmptyArray() {
		$result = API_ACM::query("");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryWithInvalidStringShouldReturnEmptyArray() {
		$result = API_ACM::query("abcdefghijklmnopqrstuvxwyz");

		$this->assertTrue(is_array($result));
		$this->assertCount(0, $result);
	}

	public function testQueryWithValidStringShouldReturnValidArray() {
		$result = API_ACM::query("PHP");

		$this->assertTrue(is_array($result));
		$this->assertGreaterThan(0, count($result));

		$this->assertGreaterThan(0, strlen($result[0]["title"]));

		$this->assertGreaterThan(0, count($result[0]["authors"]));
		$this->assertGreaterThan(0, strlen($result[0]["authors"][0]));

		$this->assertGreaterThan(0, strlen($result[0]["conference"]));

		$this->assertGreaterThan(0, strlen($result[0]["pdf"]));
	}
}
