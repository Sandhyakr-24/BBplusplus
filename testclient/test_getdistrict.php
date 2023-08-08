<?php
/**
 * test the function getDistrictFromLatLng (in servicefunctions.php) 
 */
    session_start();
   echo "in test_getdistrict.php"; 
    $appbasedirorg = dirname(__FILE__);
    $appbasedir = substr($appbasedirorg,0,-10); // remove the directory name testclient

    
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
    echo "SESSION[ABSAPP_BASE_DIR]: ".$_SESSION['ABSAPP_BASE_DIR']; 
    require_once($_SESSION['ABSAPP_BASE_DIR']."/servicefunctions/servicefunctions.php");

    $lat=26.5645;
    $lng=85.9914;
    

    $district = getDistrictFromGeocode($lat, $lng);
    echo "Lat: ".$lat." Long:".$lng." District:".$district;
    
?>    