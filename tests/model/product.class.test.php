<?php
/**
 * @backupGlobals disabled
 */
 
class productClassTest extends PHPUnit_Framework_TestCase {
	
	public function setUp()
	{
		global $db;
		$this->db = $db;
		date_default_timezone_set('America/Los_Angeles');
	}

	public function test_getProduct() {
		$objProduct = new Product($this->db);
		$objProduct->setTable();
		$objProduct->product_id = 1;
		$class = new ReflectionClass ($objProduct);
		$method = $class->getMethod ('getProduct');
		$output = $method->invoke ($objProduct);
		$this->assertGreaterThan(0, count($output));	
	}

	public function test_getTypes() {
		$objProduct = new Product($this->db);
		$objProduct->product_id = 1;
		$class = new ReflectionClass ($objProduct);
		$method = $class->getMethod ('getTypes');
		$output = $method->invoke ($objProduct);
		$this->assertGreaterThan(0, count($output));	
	}

	public function test_getPrice() {
		$objProduct = new Product($this->db);
		$objProduct->product_id = 1;
		$class = new ReflectionClass ($objProduct);
		$method = $class->getMethod ('getPrice');
		$output = $method->invoke ($objProduct, 1);
		$this->assertGreaterThan(0, count($output));	
	}
}