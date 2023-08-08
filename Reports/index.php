<?php
/**
* The entry point for the EMRP application
* 
*/
session_start();

$appconfigfile = dirname(__FILE__)."/config/appconfig.php";

$querystr = $_SERVER[QUERY_STRING];
if($querystr != '') {
	$option = $_REQUEST['option'];  // eg. http://url?option=login
}

$_SESSION['EMRP_CONFIG_FILE'] = $appconfigfile;

$appbasedir = dirname(__FILE__);
$_SESSION['EMRP_BASE_DIR'] = $appbasedir;

$option = $_REQUEST['option'];

if($option == '')
    $option = 'login';

$dbconfigfile = dirname(__FILE__)."/config/dbconfig.php";
$_SESSION['EMRP_DB_CONFIG_FILE'] = $dbconfigfile;


if (!file_exists($appconfigfile)) {
	$errmsg = $appbasedir."index.php: Failed to load Configuration file";
	syslog(3, $errmsg); // log the error to the system log file
    echo "The application has encountered a temperory technical problem while loading the configuration. Please try again later.";
	die();
}

require_once($appconfigfile);
require_once($dbconfigfile);
require_once($appbasedir."/app/boot/auto_classloader.php");

// Use HTTPS
if($cfg_usehttps) {    // Use HTTPS
   $hosturl = "https://".$_SERVER['HTTP_HOST'];
}
else {   // Use HTTP
   $hosturl = "http://".$_SERVER['HTTP_HOST'];
}

$requesturi = $_SERVER['REQUEST_URI']; 
$len = strripos($requesturi,"/",0);  // find the position of last occurance of '/'
$appurl = substr($requesturi,0,$len);
$appbaseurl = $hosturl.$appurl."/";
$_SESSION['EMRP_BASE_URL'] = $appbaseurl;

// URL for using on non-SSL pages
// For example, all Reports links are made non-SSL as 'Export to Excel' function have problem with IE-7 and IE-8 when trying to download excel file from a SSL (https) page
$hosturl_nossl= "http://".$_SERVER['HTTP_HOST'];
$_SESSION['EMRP_BASE_URL_NOSSL'] = $hosturl_nossl.$appurl."/";  

if($cfg_maintenance == 'on')  {
	header("Location: ".$appbaseurl.$cfg_maintenancepage);
	exit();
}


switch($option) {

	case 'register':  // Show User Registration Page
		
	     header("Location: ".$appbaseurl.$cfg_registrationcontroller."?taskname=show_reg_select_usertype");
	     exit();
	     break;
	
	case 'login':
				
	     header("Location: ".$appbaseurl.$cfg_logincontroller);
	     exit();
	     break;
	
	case 'home':
		
		
	     $app_helper = new app_helper();	
	     // $_SESSION['userrole_code'] = $app_helper->getUserRoleCodeByUserId($_REQUEST['id']);
	     header("Location: ".$_SESSION[EMRP_BASE_URL]."modules/home/home_controller.php?menu_left_activeitem=Home&taskname=show_homepage");
         exit();
     	 break;
		
	
	default:
	     header("Location: ".$appbaseurl.$cfg_logincontroller);
	     break;
}

session_destroy();
?>
