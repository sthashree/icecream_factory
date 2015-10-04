<?php
/**
 * @backupGlobals disabled
 */
 
class productListsClassTest extends PHPUnit_Framework_TestCase {
	
	public function setUp()
	{
		global $db;
		$this->db = $db;
		date_default_timezone_set('America/Los_Angeles');
	}

	public function test_getProducts() {
		$objProductLists = new ProductLists($this->db);
		$class = new ReflectionClass ($objProductLists);
		$method = $class->getMethod ('getProducts');
		$output = $method->invoke ($objProductLists);
		$this->assertGreaterThan(0, count($output));	
	}

}