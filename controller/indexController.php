<?php

Class indexController Extends baseController {

public function index() {
	/*** set a template variable ***/
        $this->registry->template->welcome = 'Welcome to my Ice Cream shop. ';
        $this->registry->template->message = 'Please go to product tab to select and order product.';
	/*** load the index template ***/
        $this->registry->template->show('index');
}

}

?>
