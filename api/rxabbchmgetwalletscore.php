<?php
/**
 * Service API:  rxabbchmgetwalletscore
 * File name: rxabbchmgetwalletscore.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "avatarname":"",
 * "deviceid":"",
 * }
 *    
 * JSON Response:
 * {
 * "status":"failed/success",
 * "description":"reason for failure, if status is 'failed'",
 * "childid":"",
 * "avatarname":"",
 * "deviceid":"",
 * "score":"",
 * "datetime_lastupdated":""
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

    $jsonstring = file_get_contents("php://input");
    $data = json_decode($jsonstring); 
    
    $avatarname = $data->{'avatarname'};
    $deviceid = $data->{'deviceid'};
    
    if($avatarname && $deviceid){
    
       $rtn = checkIfNameAndDeviceRegistered($avatarname, $deviceid);
        
       if(!$rtn) {
           $responsedata = array(
               'status' => "failed",
               'description' => "No Child is registered with the given name and deviceid ($avatarname, $deviceid)."
           );
           $em = new exceptionMgr(" ");
           $em->logInfo("rxabbchmgetwalletscore: Error: No Child is registered with the given name and deviceid ($avatarname, $deviceid).");
       }
       else {
           
           $childexists = checkIfNameAndDeviceRegistered($avatarname, $deviceid);
           

           if(!$childexists){
	           
	           $responsedata = array(
	               'status' => "failed",
	               'description' => "Failed to retrieve the Child details for the given name and deviceid ($avatarname, $deviceid)."
	           );
	           $em = new exceptionMgr(" ");
	           $em->logInfo("rxabbchmgetwalletscore: Error: Failed to retrieve the Child details for the given name and deviceid ($avatarname, $deviceid).");
	       }
	       else {
	           
	           $childid = getChildIdByNameAndDevice($avatarname,$deviceid);

	           if($childid == null) {
	               $responsedata = array(
	                   'status' => "failed",
	                   'description' => "Could not retrive the Child ID for the given name and deviceid"
	               );
	               $em = new exceptionMgr(" ");
	               $em->logInfo("rxabbchmgetwalletscore: Error: Could not retrive the Child ID for the given name and deviceid (".$avatarname.",".$deviceid.")");
	           }
	           else {
	               
	               $resp = getCHMwalletscore($childid);

	               if($resp != null) {
	                   $responsedata = array(
	                       'status' => "success",
	                       'description' => "Walletscore has been successfully retrieved.",
	                       'childid' => $childid,
	                       'avatarname' => $avatarname,
	                       'deviceid' => $deviceid,
	                       'score' => $resp['score'],
	                       'datetime_lastupdated' => $resp['datetime_lastupdated']
	                   );
	               }
	               else {
	                   $responsedata = array(
	                       'status' => "failed",
	                       'description' => "Failed to retrieve Walletscore Data."
	                   );
	                   $em = new exceptionMgr(" ");
	                   $em->logInfo("rxabbchmgetwalletscore: Error: Failed to retrive Walletscore Data.");
	               }
	           }
	       }
        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Input parameters missing."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("rxabbchmgetwalletscore: Error: Input parameters missing.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    