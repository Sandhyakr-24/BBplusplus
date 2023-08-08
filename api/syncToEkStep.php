<?php

/*
session_start();

$appbasedirorg = dirname(__FILE__);

$appbasedir = substr($appbasedirorg,0,-4); // remove the directory name api
$_SESSION['ABSAPP_BASE_DIR'] = $appbasedir;

$appconfigfile = $appbasedir."/config/appconfig.php";
$_SESSION['ABSAPP_CONFIG_FILE'] = $appconfigfile;

$dbconfigfile = $appbasedir."/config/dbconfig.php";
$_SESSION['ABSAPP_DB_CONFIG_FILE'] = $dbconfigfile;

$querystr = $_SERVER['QUERY_STRING'];

$hosturl = "http://".$_SERVER['HTTP_HOST'];
$requesturi = $_SERVER['REQUEST_URI'];
$lenuri = strripos($requesturi,"/",0);  // find the position of last occurance of '/'
$appurl = substr($requesturi,0,$lenuri-4); // 4 chars removed as the uri will contain 'api' directory also

$appbaseurl = $hosturl.$appurl."/";
$_SESSION['ABSAPP_BASE_URL'] = $appbaseurl;

require_once($_SESSION['ABSAPP_BASE_DIR']."/app/boot/checksandincludes.php");
*/


$appbasedirorg = dirname(__FILE__); // e.g  var/www/vhosts/kodvin.com/httpdocs/abs/api
$appbasedir = substr($appbasedirorg,0,-4); // remove the directory name api
require_once($appbasedirorg."/app/classes/curlprocessmgr.php");

$curlMgr = new curlprocessmgr();

$data_v3 = array(
  'eid' => 'OE_INTERACT',
  'ets'=> '1455031059061',
  'ver'=> '3.0',
  'mid' => '371183aa-a981-47fb-887b-27de0e071eb4',
   
   'actor' => array(
        'id' => 'baf9db76d664fbdc8ba0c270f952d081',
        'type' => 'ContentSession'
    ),
    
    'context' => array(
        'channel' => 'in.ekstep',
        'pdata' => array(
            'id'=> 'in.ekstep',
        ),
        'env'=> '',
    ),
    
    'edata' => array(
        'type' => 'TOUCH',
        'id' => 'DEVICE_BACK_BTN',
        
    )
);



$jsondata = json_encode($data_v3);

//echo "jsondata:".$jsondata;

$curlMgr->syncToEkStep($jsondata); // call the method 'syncToEkStep()' of 'curlprocessmgr' class
  
?>
