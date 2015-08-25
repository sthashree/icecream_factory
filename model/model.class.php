<?php
	abstract class Model {
		protected $_db;
		protected $_data;

		/*
		*	Constructor
		*	
		*/

		public function __construct(db $db, $data = array()) {
		    $this->_db = $db;
			$this->setTable();
			$this->_data = $data;
		}

		 abstract protected function setData($data);
		 abstract protected function setTable();    

		 /*
		 *	Getter
		 */

	 	public function __get($name) {
	         return $this->$name;
	     }

	     /*
	     *	Setter
	     */

	     public function __set($name, $value) {
	         $this->$name = $value;
	     }
	}
?>