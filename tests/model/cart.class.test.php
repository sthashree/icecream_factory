<?php
/**
 * @backupGlobals disabled
 */
 
class cartClassTest extends PHPUnit_Framework_TestCase {
	
	public $fields = array (
			'cart_id' => 1,
			'product_id' => 12, 
			'product_type_id' => 1,
			'flavour_id' => 1, 
			'no_of_scoop' => 1,
			'actual_price' => 12, 
			'final_price' => 10,
			'discount' => 2,
			'modified_date' => ''
		);

	public function setUp()
	{
		global $db;
		$this->db = $db;
		date_default_timezone_set('America/Los_Angeles');
	}

	public function test_updateCart() {
		$objCart = new Cart($this->db, $this->fields);
		$class = new ReflectionClass ($objCart);
		$method = $class->getMethod ('save');
		$output = $method->invoke ($objCart, $this->fields);
		$this->assertGreaterThan('1', $output);	
	}

	public function test_saveOrder()
	{
		$this->fields['cart_id'] = 1;
		$objCart = new Cart($this->db, $this->fields);
		$class = new ReflectionClass ($objCart);
		$method = $class->getMethod ('saveOrder');
		$output = $method->invoke ($objCart, $this->fields);
		$this->assertEquals($this->fields['cart_id'], $output);
	}

	public function test_insertCart() {
		unset($this->fields['cart_id']);
		$objCart = new Cart($this->db, $this->fields);
		$class = new ReflectionClass ($objCart);
		$method = $class->getMethod ('save');
		$output = $method->invoke ($objCart, $this->fields);
		$this->assertGreaterThan(0, $output);	
	}

	public function test_getCartInfo()
	{
		$objCart = new Cart($this->db, $this->fields);
		$class = new ReflectionClass ($objCart);
		$method = $class->getMethod ('cartInfo');
		$output = $method->invoke ($objCart, $this->fields);
		$this->assertNotCount(0, $output);
	}

}