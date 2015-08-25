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

		  /**
		  *
		  * @set undefined vars
		  *
		  * @param string $index
		  *
		  * @param mixed $value
		  *
		  * @return void
		  *
		  */
		  public function __set($index, $value)
		  {
		 	$this->$index = $value;
		  }

		  /**
		  *
		  * @get variables
		  *
		  * @param mixed $index
		  *
		  * @return mixed
		  *
		  */
		  public function __get($index)
		  {
		 	return $this->$index;
		  }
	}
?>