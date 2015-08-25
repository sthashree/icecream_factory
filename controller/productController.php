<?php
	Class productController extends baseController {
		

		/*
		*	@desc : List products and its all detail.
		*/

		public function index() {
			if($_GET['order'] == 'success')
			{
				$this->registry->template->messages = 'Ordered Succesfully';	
			}
			$objProducts = new productLists($this->registry->db);
		/*** set a template variable ***/
	        $this->registry->template->flavours = $objProducts->getFlavours();
	        $this->registry->template->products = $objProducts->getProducts();
		/*** load the index template ***/
	        $this->registry->template->show('product-list');
		}
	}

?>