<?php
/**
 * Defines all server-specific constants, such as database and email credentials
 *
 * @name 	server_config.inc.php
 *
 */
 
date_default_timezone_set('America/New_York');

define('IP', '192.168.100.60');


define('THIS_CONSTANT_NOT_TO_BE_DEFINED_IN_PRODUCTION', true);

//database names
define('UNIFIED', 'D_unified_2008');

define('DB', 'D_genentech_2014');

define('TEMP_DB', 'D_temporary_2009');

//For Images
define('IMAGE_URL', 'http://'.IP.'/shared/images/');

//FOR EMAILS
define('LOCAL_URL', 'http://'.IP.'/unified_2008_int/htdocs/');

//mail creds
define('SMTP_HOST', 'smtp.arrowtack.net');
define('SMTP_USER', 'devtest@medforce.net');
define('SMTP_PASS', 'nm1S0Dmcl');
define('NO_SMTP_AUTH', true);

//database creds
define('DB_HOST', '192.168.100.62');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_ADMIN_USER', '');
define('DB_ADMIN_PASS', '');
 
define('CC_KEY', 'newyear');
define('DB_CC_HOST', '192.168.100.62');
define('DB_CC_USER', '');
define('DB_CC_PASS', '');

//xajax include path
define('XAJAX_REQUIRE_PATH', '/home/dev/www/global_2007_all/htdocs/shared/rev1/js/xajax/');
define('XAJAX_URI_PATH', 'http://192.168.100.60/global_2007_all/htdocs/shared/rev1/js/xajax/');

//global jquery directory
define('JQUERY_REQUIRE_PATH', '/home/dev/www/global_2007_all/htdocs/shared/rev1/js/jquery/');
define('JQUERY_URI_PATH', 'http://192.168.100.60/global_2007_all/htdocs/shared/rev1/js/jquery/');

//db character encoding
define('DB_CHARSET', 'CP1252');

//meeting/speaker files file size limit in bytes
define('FILE_SZ_LIMIT', 5000000);


/* DON'T FORGET ENDING SLASH. */
define('WEBREG_URL','http://192.168.100.60/webreg_2009_ext/htdocs/');

//define('WEBREG_URL','http://medforcereg.net/');

//Google Maps API
define('GOOGLE_MAPS_CLIENT_ID', 'gme-callinc');

//db encryption key
define('DB_KEY', 'icecream');

// BEACON authentication 
// only for allergan
if(DB == 'D_allergan_2009' )
{
	//dev
	define('SERVICE_ACCOUNT','CPIC_SP_MEDF');
	define('SERVICE_PWD','M3dforce');
	define('VENDOR_PWD','test');
	define('WSDL','D_BeaconServiceOutMedforce1_0.wsdl');
}
if(DB == 'allergan_2009' )
{
	//prod
	define('SERVICE_ACCOUNT','CPIC_SP_MEDF');
	define('SERVICE_PWD','$peaker1');
	define('VENDOR_PWD','PmQ39087Q7TU0U3');
	define('WSDL','BeaconServiceOutMedforce1_0.wsdl');
}

//only for ACCOUNT and EVENT import/export genentech files DB
define('FILES_DB_GENENTECH',' D_genentech_files_2014');
?>
