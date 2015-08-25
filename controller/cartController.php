<?php
	Class cartController extends baseController {
		
		public function index() {
			
		}

		/*
		*	@desc : Add Item to Cart
		*/

		public function add() {
			$objCart = new cart($this->registry->db, $_POST);
			$objCart->save();
			header('Location: http:index.php?p=cart/show');
		}

		/*
		*	@desc : Display Cart Item
		*/

		public function show()
		{
			$this->registry->template->cart_messages = "Your cart";
			if($_GET['order'] == 'fail')
			{
				$this->registry->template->messages = 'Ordered cannot be done. Try again.';	
			}
			$objCartLists = new cartLists($this->registry->db);
		/*** set a template variable ***/
	        $this->registry->template->carts = $objCartLists->getCarts();
		/*** load the template ***/
	        $this->registry->template->show('cart-list');
		}


		/*
		*	@desc : Order from cart
		*/

		public function order() {
			$objCart = new cart($this->registry->db, $_POST);
			$id = $objCart->saveOrder();
			if($id>0)
			{
				header('Location: http:index.php?p=product&order=success');
			}
			else {
				header('Location: http:index.php?p=cart/show&order=fail');

			}
		}
	}

?>