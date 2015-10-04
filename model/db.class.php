<?php
class DB {
	var $_uses = null;
	var $_data = null;
	public $_conn;

	/*
	*	Constructor
	*   Create DB connection 
	*/
	
	function __construct($CONN_STRING,$USER_NAME,$PWD)
	{
		$this->_conn = new PDO($CONN_STRING,$USER_NAME,$PWD);
		$this->_conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		return $this->_conn;
	}

	/*
	*	Set data
	*/

	public function setData($data) {

		$this->_data = $data;
	}

	/*
	*	Set Table for DBdatabase use
	*/

	public function setTable($uses) {
		$this->_uses = $uses;
	}
	
	/*
	*	Save and update table set from setTable and setData
	*/

	function Save($id = array())
	{
		$status = FALSE;
		$id_val = 0;
		if(is_array($this->_data))
		{
			
			foreach($this->_data as $key=>$val)
			{
				$elements[] = $key;
				$element_values[] = $val;
			}
			print_r($element_values);
			try{
					if(count($id) > 0)
					{
						$key = array_keys($id);
						$id_val = $id[$key[0]];
						$sql = "update ".$this->_uses." set ".join(' = ?,',$elements)." = ? where ".$key[0]." = ".$id_val;
						
					}
					else
					{
						$sql = "insert into ".$this->_uses."(".join(',',$elements).") values(".$this->what(count($elements)).")";
					}
					$stmt = $this->_conn->prepare($sql);
  			  		$stmt->execute($element_values);
					if($stmt->rowCount()>0){
						if(!$id_val) $id_val = $this->_conn->lastInsertId();
					}else{
						$status = FALSE;
					}
				}
			catch(Exception $e)
				{
				 	  //print $e->getMessage();
				}
		}
		//echo $id_val;
		return $id_val;
	}

	/*
	*	Select from setTable table,
	*   @param : $limit  	limit of table 	ex: 'limit 0,10'
	*			 $id 		set if only row for this id is needed
	*			 $field 	Ordering field
	*			 $order		sorting
	*			 $cols 		array of Columns to display	
	*/
	
	function Find($limit = null,$id = 'all',$field='id',$order='asc',$cols=array('*'))
	{
		$item = array();
		try{
					if(intval($id) > 0)
					{
						$sql = "select * from ".$this->_uses." where ".$field." = ".$id." order by $field $order limit 0,1";
						$result = $this->_conn->query(trim($sql));
						$item = $result->fetchObject();
						
					}
					else
					{
						if($id =='all')
						{
							$sql = "select * from ".$this->_uses." order by $field $order $limit";
						}else
						{
							$sql = "select ".join(',',$cols)." from ".$this->_uses." order by $field $order $limit";
						} 			  			
						$result = $this->_conn->query(trim($sql));
					   // $result->setFetchMode(PDO::FETCH_CLASS,stdClass );
						while($data = $result->fetchObject())
						{
							$item[] = $data;
						}
					}
				}
			catch(Exception $e)
				{
				 	  echo $e->getMessage();
				}
		return $item;
	}

	/*
	*	Delete from table
	*/
	
	function Delete($id)
	{
		$status = FALSE;
		if(intval($id)>0)
		{
			try{
					$stmt = $this->_conn->prepare("delete from ".$this->_uses." where id = ? limit 1");
					$stmt->execute(array($id));
					if($stmt->rowCount()>0){
						$status = TRUE;
					}else{
						$status = FALSE;
					}
				}
			catch(Exception $e)
				{
				 	  //print $e->getMessage();
				}
		}
		return $status;
	}
	/*
	*	Select from table not set by setTable
	*	@param 	:	$table 		Table name
	* 				$string 	Search String
	*/

	function SearchCustom($table,$search_string="")
	{
		$item = array();	
		try{
					if($search_string!="") $search_string = "where ". $search_string;
					$sql = "select t.* from `".$table."` as t $search_string ";	  			
					$result = $this->_conn->query(trim($sql));
					while($data = $result->fetchObject())
					{
						$item[] = $data;
					}
				}
			catch(Exception $e)
				{
				 	  print $e->getMessage();
				}
		return $item;
	}

	/*
	*	Fetch Data from custom SQL
	* 	@param 	$sql 	Custom sql
	*/

	function fetchData($sql)
	{
			$result = $this->_conn->query(trim($sql));
		    while($data = $result->fetchObject())
			{
				$item[] = $data;
			}
		    return $item;
	}

	/*
	*	To get ? equal to columns for insert
	*/
	protected function what($count)
	{
		$what = '?' ;
		for($i = 1; $i < $count ; $i++)
		{
			$what .= ',?';
		}

		return $what;
	}
}
?>