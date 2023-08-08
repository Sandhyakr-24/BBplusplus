<?php
/**
 * find the district from latitude and longitude and update the 'district' field in the child_tbl 
 * This script is used to update the 'district' field for all the existing entries in the child_tbl (already registered children, where district was not updated)
 */
    session_start();

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

    require_once($_SESSION['ABSAPP_BASE_DIR']."/servicefunctions/servicefunctions.php");

    // read the latitude and longitude values of all the existing records in child_tbl
    $dbh = services_dbhandler::getInstance();
    $query = "SELECT id_child, geo FROM child_tbl";

    $arrResult = $dbh->readRecordsWithQuery($query);
    // print_r($arrResult);
    
    // for each record, find the 'District' and update the 'district' field in child_tbl
    foreach($arrResult as $res) {
        
        // read the geo value and split into latitude and longitude
        //print_r($res);
        $geo = $res['geo'];
        $latlong = explode(",",$geo);
        $lng = $latlong[0];
        $lat = $latlong[1];
        $id_child = $res['id_child'];
      
        // get the district value
        
        $district = getDistrictFromGeocode($lat, $lng);
 
        // update the 'district' field in child_tbl
        if($district != "") {
            echo "*** SUCCESS: Updating 'district' for id_child:".$id_child." lat:".$lat." long:".$lng." District:".$district."###";
            updateDistrict($district,$id_child);
        }
        else {
            echo "*** FAIL: 'district' null for id_child:".$id_child." lat:".$lat." long:".$lng." District:".$district."###";
  
        }
    }
    
?>    