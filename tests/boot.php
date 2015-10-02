<?php
ini_set('error_reporting', E_ALL );
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once("server_config.inc.php");
require_once 'rev3/class/fatal_error_exception.class.php';

if (!function_exists("money_format"))
{
	function money_format($format, $number) 
	{ 
		return $number; 
	} 
}

if (!function_exists("mf_real_escape_string"))
{
	function mf_real_escape_string($str)
	{
		global $mdb2;
		return $mdb2->quote($str);
	}
}
// Add user global to include path
preg_match("/home\/[^\/]+/", dirname(__FILE__), $match);
if (count($match))
{
	$path = explode("/",$match[0]);
	$user = $path[1];

	$global_path = "/home/$user/public_html/global_2007_all/htdocs/include";
	set_include_path($global_path . PATH_SEPARATOR . get_include_path());

	$global_path = "/home/$user/public_html/global_2007_all/htdocs/include/rev5";
	set_include_path($global_path . PATH_SEPARATOR . get_include_path());
}

$global_path = "./htdocs/include/rev5/";
set_include_path($global_path . PATH_SEPARATOR . get_include_path());

$global_path = "./htdocs/include/";
set_include_path($global_path . PATH_SEPARATOR . get_include_path());

$include_paths = explode(PATH_SEPARATOR,get_include_path());
spl_autoload_register(function($class_name) use($include_paths)
{
	for($i = 0; $i < count($include_paths); $i++)
	{
		if(file_exists(strtolower($include_paths[$i].'/'.str_replace('\\', '/', $class_name).'.php')))
		{
			require_once strtolower($include_paths[$i].'/'.str_replace('\\', '/', $class_name).'.php');
			return;
		}
		else if (file_exists($include_paths[$i].'/'.str_replace('\\', '/', $class_name).'.php'))
		{
			require_once $include_paths[$i].'/'.str_replace('\\', '/', $class_name).'.php';
			return;
		}
	}
});

//DB connection vars
$db_user = DB_USER;
$db_pass = DB_PASS;

define('DSN', 'mysql://'.$db_user.':'.$db_pass.'@'.DB_HOST.'/'.DB);

$mdb2 = new db\PDOConnection(DSN);

try
{
	$mdb2->connect();
}
catch(PDOException $e)
{
	$errorToScreen = '
		<table>
		<tr><td>PDO MESSAGE:</td><td>'.$e->getMessage().'</td></tr>';
    die($errorToScreen);
}

// $mdb2->setFetchMode(MDB2_FETCHMODE_ASSOC);

function runQuery($sql, $encrypt=true) {
	// Perform the query
	global $mdb2;
	global $mcb_profiling;
	
	if(isset($mcb_profiling))
	{
		$mcb_profiling->startSqlExecution($sql);
	}
	
	try
	{
		$res = $mdb2->query($sql);
	}
	catch(Exception $e)
	{
		throw new FatalErrorException($sql.'<br>'.$e->getMessage());
	}
	
	if(isset($mcb_profiling))
	{
		$mcb_profiling->endSqlExecution();
	}
	return $res;
}

$_SESSION = array(
	"user_id"	=> 0
);

$mdb2->query("SET CHARACTER SET utf8");
// echo $global_path;