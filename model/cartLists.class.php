<?php
	class CartLists {

		/*
		*	Constructor
		*/

		public function __construct(db $db)
		{
			$this->_db = $db;
		}

		/*
		*	Get cart and product detail of that cart
		*/
		public function getCarts()
		{
			$sql = "
				SELECT 
					* 
				FROM
					cart_product cp
				INNER JOIN cart c ON (c.cart_id = cp.cart_id AND c.ordered_date = '0000-00-00 00:00:00' AND c.created_user = 1)
				LEFT JOIN products p ON (p.product_id = cp.product_id)
				LEFT JOIN product_type pt ON (pt.type_id = cp.product_type_id)	
			";
			$carts = $this->_db->fetchData($sql);
			return $carts;	
		}
	}
?>