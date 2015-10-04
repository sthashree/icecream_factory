<?php

	Class Product extends Model{
		public $product_name;
		public $max_scoop;
		public $modified_date;
		public $modified_user;
		private $table = 'products';

		/*
		*	Set Data
		*/

		public function setData($data) {
			$this->_db->setData($this->data);
		}

		/*
		*	Set Table
		*/
		public function setTable() {
			$this->_db->setTable($this->table);
		}

		/*
		*	Get Product
		*/
		public function getProduct()
		{
			echo $this->product_id;
			return $this->_db->Find('', $this->product_id, 'product_id');
		}


		/*
		*	Get Product types
		*/

		public function getTypes()
		{
			return $this->_db->SearchCustom('product_type', 'product_id = '.$this->product_id);
		}


		/*
		*	Get Product Price by combination of product and type
		*/
	
		public function getPrice($type_id)
		{
			return $this->_db->SearchCustom('product_price', 'product_id = '.$this->product_id.' and type_id = '.$type_id);
		}
	}

?>