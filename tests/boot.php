<?php
ini_set('error_reporting', E_ALL );
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
require_once('../includes/config.inc.php');


 define ('__SITE_PATH', '../');


function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        $file = __SITE_PATH . '/controller/' . $filename;
    }
    if (file_exists($file) == false)
    {
        return false;
    }
  include ($file);
}

$db = new db($CONN_STRING,$USER_NAME,$PWD);
