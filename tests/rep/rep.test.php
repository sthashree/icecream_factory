<?php
/**
 * @backupGlobals disabled
 */
 
Class RepTest extends PHPUnit_Framework_TestCase {
	
	public $wwid;
	private $unified = UNIFIED;
	public $fields = array(
		'ref_sf_member' => array(
			'firstname'		=>	'1',
			'midname'		=>	'0',
			'lastname'		=>	'1',
			'address1'		=>	'0',
			'address2'		=>	'0',
			'city'			=>	'0',
			'state'			=>	'0',
			'zip'			=>	'0',
			'active'		=>	'0',
			'fax'			=>	'0',
			'cell_phone'	=>	'0',
			'work_phone'	=>	'0',
			'voicemail'		=>	'0',
			'email'			=> 	'0',
			'login'			=>	'0',
			'passwd'		=>	'0',
			'passwd_plain'=>	'0',
			'wwid'			=> 	'0'
			)
		);
	public $post_data = array(
			array(
				'firstname'		=>	"T'est",
				'midname'		=>	'0',
				'lastname'		=>	'Test',
				'address1'		=>	'0',
				'address2'		=>	'0',
				'city'			=>	'0',
				'country'		=>	'US',
				'state'			=>	'0',
				'zip'			=>	'0',
				's.active'		=>	'0',
				'fax'			=>	'0',
				'cell_phone'	=>	'0',
				'work_phone'	=>	'0',
				'voicemail'		=>	'0',
				'email'			=> 	'0',
				'login'			=>	'0',
				'passwd'		=>	'0',
				'passwd_plain'=>	'0',
				's.wwid'			=> 	'yih3',
				'rdt'			=> 	'0B341C3'
			)
		);

	public $expected_output = array(
			array(
				'firstname'		=>	"T\'est",
				'midname'		=>	'0',
				'lastname'		=>	'Test',
				'address1'		=>	'0',
				'address2'		=>	'0',
				'city'			=>	'0',
				'country'		=>	'US',
				'state'			=>	'0',
				'zip'			=>	'0',
				's.active'		=>	'0',
				'fax'			=>	'0',
				'cell_phone'	=>	'0',
				'work_phone'	=>	'0',
				'voicemail'		=>	'0',
				'email'			=> 	'0',
				'login'			=>	'0',
				'passwd'		=>	'0',
				'passwd_plain'	=>	'0',
				's.wwid'		=> 	'yih3',
				'rdt'			=> 	'0B341C3'
			)
		);

	public function setUp() {
		global $mdb2;
		$this->wwid = 'yih3';

		//DB connection vars
		$this->mdb2	=	$mdb2;
	}

	public function test_makeCleanInput() {

		$objRep = new \rep\Rep($this->mdb2);
		$class = new ReflectionClass ($objRep);
		$method = $class->getMethod ('makeCleanInput');
		$method->setAccessible(true);
		foreach($this->post_data as $key => $p_data) {			
			$output = $method->invoke($objRep, $p_data);
			$this->assertEquals($this->expected_output[$key], $output );	
		}
	}


	public function test_makeCleanOutput() {

		$objRep = new \rep\Rep($this->mdb2);
		$class = new ReflectionClass ($objRep);
		$method = $class->getMethod ('makeCleanOutput');
		$method->setAccessible(true);
		$output = $method->invoke($objRep, $this->expected_output );
		$this->assertEquals($this->post_data, $output );
		
	}

	public function test_updateRep() {

		$_POST = array(
			'firstname'		=>	"Test",
			'midname'		=>	'0',
			'lastname'		=>	'Test',
			'address1'		=>	'0',
			'address2'		=>	'0',
			'city'			=>	'0',
			'country'		=>	'US',
			'state'			=>	'0',
			'zip'			=>	'0',
			'active'		=>	'0',
			'fax'			=>	'0',
			'cell_phone'	=>	'0',
			'work_phone'	=>	'0',
			'voicemail'		=>	'0',
			'email'			=> 	'0',
			'login'			=>	'0',
			'passwd'		=>	'0',
			'passwd_plain'=>	'0',
			'wwid'			=> 	'yih3'
		);



		$objRep = new \rep\Rep($this->mdb2, $this->fields);
		$class = new ReflectionClass ($objRep);
		$method = $class->getMethod ('updateRep');
		$output = $method->invoke ($objRep, $this->wwid);
		$this->assertEquals($output, "success");

		//Invalid
		$output = $method->invoke ($objRep, '');
		$this->assertEquals($output, "invalid");
	}


	public function test_getRepList() {

		$objRep = new \rep\Rep($this->mdb2);
		$class = new ReflectionClass ($objRep);
		$method = $class->getMethod ('getRepList');

		// Get a single Rep
		$searchClause = " AND s.wwid = '".$this->wwid."'";		
		$ordering=' order by p.rdt asc';
		$paging = ' limit 0,1';
		$output = $method->invoke($objRep, $searchClause, $ordering, $paging);
		$this->assertEquals(count(array_intersect($output[0], $this->post_data[0])), count($output[0]));

		$this->assertEquals($objRep->getRepListCount($searchClause), 1);

		//No rep exists 
		$searchClause = " AND s.wwid = 'abcd123458989hhhhhhh'";
		$output = $method->invoke($objRep, $searchClause);
		$this->assertEquals(count($output), 0);

		$this->assertEquals($objRep->getRepListCount($searchClause), 0);

		//Single Rep Data
		$method = $class->getMethod ('getRep');
		$output = $method->invoke($objRep, $this->wwid);
		$this->assertEquals(count(array_intersect($output, $this->post_data[0])), count($output));

		//Multiple Rep Data
		$method = $class->getMethod ('getRep');
		$output = $method->invoke($objRep);
		$this->assertGreaterThanOrEqual(1, count($output));


		$this->assertEquals($objRep->getTableRowDataSQL('', $this->fields, $searchClause, $ordering, $paging),'');
	}

	public function test_getProjectUserTypeSQL() {
		$objRep = new \rep\Rep($this->mdb2);
		$fields = array ( 
				'p.rdt', 
				'pj.project_name', 
				'u.user_type_name'
				);
		$searchClause = "p.wwid = '$this->wwid'";
		$ordering=' order by p.rdt asc';
		$paging = ' limit 0,1';
		$expectedResult = $this->getProjectData();
		$this->assertEquals($objRep->getProjectUserTypeSQL($fields,$searchClause, $ordering, $paging), $expectedResult['sql']);  // Make sql 
	}
	
	public function test_getRepNotesSQL() {	
		$_SESSION['user_id'] = 402;
		$objRep = new \rep\Rep($this->mdb2);
		$searchClause = "n.wwid = '$this->wwid'";
		$ordering=' order by update_time desc';
		$paging = ' limit 0,1';
		$expectedResult = $this->getNoteData();
		$this->assertEquals($objRep->getRepNotesSQL($searchClause, $ordering, $paging), $expectedResult['sql']);  // Make sql 
	}

	public function test_note() {
		$objRep = new \rep\Rep($this->mdb2);
		$_SESSION['user_id'] = 402;
		//Adding Note
		$data['rep_note'] = 'Test note';
		$data['user_id'] = $_SESSION['user_id'];
		$this->assertEquals($objRep->addNote($data), 1);

		//blank note  
		$data['rep_note'] = '';
		$data['user_id'] = $_SESSION['user_id'];
		$this->assertEquals($objRep->addNote($data), 'invalid');

		//updating Note
		$id = $this->mdb2->lastInsertId();
		$data['rep_note'] = 'Test updated note';
		$this->assertEquals($objRep->addNote($data, $id), 1);
		
		//empty where clause
		$this->assertEquals($objRep->deleteNote(''), 0);
		
		//delete Note
		$this->assertEquals($objRep->deleteNote('note_id='.$id), 1);

	}


	protected function getProjectData(){
		$searchClause = "p.wwid = '$this->wwid'";
		$ordering=' order by p.rdt asc';
		$paging = ' limit 0,1';
		$sql = <<<SQL
			SELECT 
				p.rdt, pj.project_name, u.user_type_name
			FROM
				ref_position p 
			INNER JOIN xref_position_project x ON (p.position_id = x.position_id) 
			LEFT JOIN mf_user_type u ON (p.user_type_id = u.user_type_id AND x.project_id = u.project_id)
			LEFT JOIN ref_project pj ON (x.project_id = pj.project_id)
			WHERE 
				$searchClause
				$ordering
				$paging
SQL;
		$result['sql'] = $sql;
		$result['data'] = runQuery($sql)->fetchRow();
		return $result;
	}

	protected function getNoteData() {
		$searchClause = "n.wwid = '$this->wwid'";
		$ordering=' order by update_time desc';
		$paging = ' limit 0,1';
		$sql = <<<SQL
			SELECT 
				n.*, 
				u.username,
				CASE 
					WHEN u.user_id = '402'
					THEN 1
					ELSE 0
				END allow_action
					
			FROM 
				mf_sf_member_notes n 
			INNER JOIN $this->unified.`users` u ON u.`user_id` = n.`user_id`
			WHERE 
				$searchClause
				$ordering
				$paging
SQL;
		$result['sql'] = $sql;
		$result['data'] = runQuery($sql)->fetchAll();
		return $result;
	}	
}

?>