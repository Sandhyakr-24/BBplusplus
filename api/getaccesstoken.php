<?php
/**
 * Service API:  getaccesstoken
 * File name: getaccesstoken.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "name":"",
 * "deviceid":""
 * }
 *    
 * JSON Response:
 * {
 *  "status":"failed/success",
 *  "description":"reason for failure/access token on success"
 * }
 * 
 */
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
    
    require_once($_SESSION['ABSAPP_BASE_DIR']."/servicefunctions/servicefunctions.php");

    // get posted data
    // $jsonstring = $_GET['json']; // Use this _GET and comment out file_get_contents to test directly from browser http://.../getaccesstoken.php?json={"name":"","deviceid":""}
    // Using file_get_contents instead to get the content to a string.
    // Note: json_decode works only with UTF-8 encoded strings.
    // So, if not UTF-8 encoded, use the function  $jsonstring = utf8_encode($jsonstring) before calling json_decode
    $jsonstring = file_get_contents("php://input");
    $data = json_decode($jsonstring); 
    
    $childname = $data->{'name'};
    $deviceid = $data->{'deviceid'};
    
    if($childname && $deviceid){
    
	       $accesstoken = getAccessTokenForChildForDevice($childname,$deviceid);	
	       	    
           if(!$accesstoken) {
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Failed to retrieve access token for the Child for the device ($childname, $deviceid)."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("getaccesstoken: Error: Failed to retrieve access token for the Child for the device ($childname,$deviceid)");
           }
           else {
               $responsedata = array(
                   'status' => "success",
                   'description' => $accesstoken
               );
           }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Inputs missing. name or the deviceid is missing"
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("getaccesstoken: Error: Inputs missing. name or the deviceid is missing");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    