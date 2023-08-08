<?php
/**
 * Service API:  getchild
 * File name: getchild.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "name":"",
 * "deviceid":"",
 * }
 *    
 * JSON Response:
 * {
 * "status":"failed/success",
 * "description":"reason for failure, if status is 'failed'",
 * "childid":"",
 * "name:"",
 * "deviceid":"",
 * "grade":"",
 * "schooltype:"1/0", 
 * "geo":"lat,long"
 * "language":""
 * "organization":"",
 * "avatarpic":"picture image as base64 encoded string"
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

    $jsonstring = $_GET['json']; 
    //$jsonstring = file_get_contents("php://input");
    $data = json_decode($jsonstring); 
    
    $childname = $data->{'name'};
    $deviceid = $data->{'deviceid'};
    
    if($childname && $deviceid){
    
        $rtn = checkIfNameAndDeviceRegistered($childname, $deviceid);
        
       if(!$rtn) {
           $responsedata = array(
               'status' => "failed",
               'description' => "No Child is registered with the given name and deviceid ($childname, $deviceid)."
           );
           $em = new exceptionMgr(" ");
           $em->logInfo("getchild: Error: No Child is registered with the given name and deviceid ($childname, $deviceid).");
       }
       else {
           
           $objChild = getChildByNameAndDevice($childname, $deviceid);

	       if(!$objChild){
	           
	           $responsedata = array(
	               'status' => "failed",
	               'description' => "Failed to retrieve the Child details for the given name and deviceid ($childname, $deviceid)."
	           );
	           $em = new exceptionMgr(" ");
	           $em->logInfo("getchild: Error: Failed to retrieve the Child details for the given name and deviceid ($childname, $deviceid).");
	       }
	       else {
	           
	           //$avatarpic = getAvatarpicEncodedStringByChildId($objChild->getChildId());

	           $responsedata = array(
	               'status' => "success",
	               'description' => "Child details have been successfully retrieved.",
	               'childid' => $objChild->getChildId(),
	               'name' => $objChild->getChildName(),
	               'deviceid' => $objChild->getDeviceId(),
	               'grade' => $objChild->getGradeName(),
	               'schooltype' => $objChild->getSchoolTypeId(),
	               'geo' => $objChild->getGeo(),
	               'language' => $objChild->getLanguageName(),
	               'organization' => $objChild->getOrg(),
	               'avatarpic' => $avatarpic
	           );
	       }
        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Input parameters missing."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("getchild: Error: Input parameters missing.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    