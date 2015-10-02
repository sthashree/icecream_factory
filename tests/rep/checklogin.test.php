<?php
/**
 * @backupGlobals disabled
 */
 
class CheckLoginTest extends PHPUnit_Framework_TestCase {
	
	public $login;
	public $passwd_plain;
	public $active;

	public function setUp() {
		$rep = $this->getRepWithLogin();
		$this->wwid = $rep['wwid'];
		$this->login = $rep['login'];
		$this->passwd_plain = $rep['passwd_plain'];
		$this->active = $rep['active'];
	}

	public function test_truecheckInfo() {
		$preparer = new \rep\Checklogin($this->wwid);
		$this->assertTrue($preparer->checkInfo());
	}

	public function test_blankLogin() {		
		$preparer = new \rep\Checklogin($this->wwid);
		$preparer->loginInfo['login'] = '';
		$this->assertFalse($preparer->checkInfo());
	}

	public function test_blankPasswd() {		
		$preparer = new \rep\Checklogin($this->wwid);
		$preparer->loginInfo['login'] = $this->login;
		$preparer->loginInfo['passwd_plain'] = '';
		$this->assertFalse($preparer->checkInfo());
	}

	public function test_inActiveRep() {		
		$preparer = new \rep\Checklogin($this->wwid);
		$preparer->loginInfo['login'] = $this->login;
		$preparer->loginInfo['passwd_plain'] = $this->passwd_plain;
		$preparer->loginInfo['active'] = 0;
		$this->assertFalse($preparer->checkInfo());
	}

	private function getRepWithLogin() {
	$sql = <<<SQL
				SELECT 
					wwid,
					active,
					login,
					passwd_plain
				FROM 
					ref_sf_member
				WHERE 
					login !=''
				AND	
					passwd_plain !=''
				AND 
					active = '1'		

SQL;
		return runQuery($sql)->fetchRow();
	}
}

?>