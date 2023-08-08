<?php
/**
 * Service API:  login
 * File name: login.php
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

 
    $jsonstring = file_get_contents("php://input");
    $data = json_decode($jsonstring); 
    
    $childname = $data->{'name'};
    $deviceid = $data->{'deviceid'};
    
    if($childname && $deviceid){
    
        $childid = login($childname, $deviceid);
	
	   if(!$childid){
	           
	           $responsedata = array(
	               'status' => "failed",
	               'description' => "No Child exists with the given name and device ($childname, $deviceid)."
	           );
	           $em = new exceptionMgr(" ");
	           $em->logInfo("login: Error: No Child exists with the given name and device ($childname, $deviceid).");
	   }
	   else {

	       $access_token = createAccessToken();	
	    
	       //Check if access token exists for this child and device
	    
	       $isExists = checkIfAccessTokenExistsForChildForDevice($childid,$deviceid);
	       
	       $created_datetime = date('Y-m-d H:i:s') ;
	       	    
	       if($isExists){
		
	           updateAccessToken($childid,$deviceid,$access_token,$created_datetime);
	       }
	       else {
		
		      //Update/Save new access token
		      saveNewAccessTokenForChildForDevice($childid,$deviceid,$access_token,$created_datetime);	    
	       }
	    
	       $responsedata = array(
	          'status' => "success",
	          'description' => $access_token
	       );

	   }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Input parameters missing."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("login: Error: Input parameters missing.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    