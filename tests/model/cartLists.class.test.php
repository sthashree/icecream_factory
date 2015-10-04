<?php
/**
 * @backupGlobals disabled
 */
 
class cartListsClassTest extends PHPUnit_Framework_TestCase {
	
	public function setUp()
	{
		global $db;
		$this->db = $db;
		date_default_timezone_set('America/Los_Angeles');
	}

	public function test_getCarts() {
		$objCartLists = new CartLists($this->db);
		$class = new ReflectionClass ($objCartLists);
		$method = $class->getMethod ('getCarts');
		$output = $method->invoke ($objCartLists);
		$this->assertGreaterThan(0, count($output));	
	}

}