<?php
	class ProductLists {


		/*
		*	Constructor
		*/

		public function __construct(db $db)
		{
			$this->_db = $db;
		}


		/*
		*	Get List of Products
		*/

		public function getProducts()
		{
			$this->_db->setTable('products');
			$products = $this->_db->find('', 'all', 'product_name');
			foreach($products as $product)
			{
				$objProduct 	= new Product($this->_db);
				$objProduct->product_id = $product->product_id;				
				$types 					= $objProduct->getTypes();		
				$product->types 		= $types;
				$productDetail[] 		= $product;

			}
			return $productDetail;	
		}


		/*
		*	Get List of Flavours
		*/

		public function getFlavours()
		{
			$this->_db->setTable('flavours');
			return $this->_db->find('', 'all', 'flavour_name');

		}

	}
?>