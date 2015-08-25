<?php

	Class Cart extends Model{


		/*
		*	array of database fields
		*/
		private $field_array = array (
				'cart_id',
				'product_id', 
				'product_type_id' ,
				'flavour_id', 
				'no_of_scoop',
				'actual_price', 
				'final_price',
				'discount',
				'modified_date'
				);

		protected $_data;


		/*
		*	default table
		*/
		private $table = 'cart';


		/*
		*	Set data to db class
		*/

		protected function setData($data) {
			$this->_db->setData($this->data);
		}


		/*
		*	Set table to db class
		*/
		protected function setTable() {
			$this->_db->setTable($this->table);
		}


		/*
		*	Create new cart if not exists for user 
		*   Store products on cart
		*/
		public function save()
		{
			$valid_data = array();
			$cart_data['amount'] = 0;
			foreach($this->_data as $key => $data)
			{
				if(in_array($key, $this->field_array))
				{
					$valid_data[$key] = $data;
					if($key == 'actual_price') $cart_data['amount'] += $data;
				}
			}
			$cart_data['created_date'] = date('Y-m-d h:m:s');
			$cart_data['created_user'] = 1;
			$existingCart = $this->cartInfo();

		
			if(count($existingCart) == 1)
			{
				$cart_data['amount'] += $existingCart[0]->amount;
				$cart_id['cart_id'] = $existingCart[0]->cart_id;
			}
			$this->_db->setData($cart_data);
			$valid_data['cart_id'] = $this->_db->Save($cart_id);

			// Update into product cart table
			$this->_db->setTable('cart_product');
			$this->_db->setData($valid_data);
			$this->_db->Save();
		}

		/*
			get cart information
		*/
		protected function cartInfo()
		{
			$search = "created_user = 1 AND ordered_date = '0000-00-00 00:00:00'";
			return $this->_db->SearchCustom('cart', $search);
		}

		/*
		*	Save Order from cart
		*/

		public function saveOrder()
		{
			$cart_id['cart_id'] = $this->_data['cart_id'];
			$data['ordered_date'] 	= date('Y-m-d h:m:s');
			$this->_db->setData($data);
			return $this->_db->Save($cart_id);
		}

	}

?>