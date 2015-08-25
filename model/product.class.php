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

		protected function setData($data) {
			$this->_db->setData($this->data);
		}

		/*
		*	Set Table
		*/
		protected function setTable() {
			$this->_db->setTable($this->table);
		}

		/*
		*	Get Product
		*/
		public function getProduct()
		{
			return $this->_db->find('', $product_id);
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