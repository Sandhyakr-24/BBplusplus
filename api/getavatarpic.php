<?php
/**
 * Service API:  getavatarpic
 * File name: getavatarpic.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "name:"",
 * "deviceid":"",
 * }
 *    
 * JSON Response:
 * {
 *  "status":"failed/success",
 *  "description":"reason for failure/picture image as base64 encoded string on success"
 * }
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
    
  
    if($data) {
        $childname = $data->{'name'};
        $deviceid = $data->{'deviceid'};
  
        if($childname && $deviceid){
        
            $childid = getChildIdByNameAndDevice($childname, $deviceid);

           if(!$childid) {
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Given combination of name and device ($childname, $deviceid) does not exist."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("getavatarpic: Error: Given combination of name and device ($childname, $deviceid) does not exist.");
           }
           else {
               
               $avatarpic_base64string = getAvatarpicEncodedStringByChildId($childid);
               
               if(($avatarpic_base64string == null) || ($avatarpic_base64string == '')) {
                    $responsedata = array(
                        'status' => "failed",
                        'description' => "Failed to retrieve the avatar picture for ($childname, $deviceid)."
                    );
                    $em = new exceptionMgr(" ");
                    $em->logInfo("getavatarpic: Error: Failed to retrieve the avatar picture for ($childname, $deviceid).");
               }
               else {
                   $responsedata = array(
                       'status' => "success",
                       'description' => $avatarpic_base64string
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
            $em->logInfo("getavatarpic: Error: Input parameters missing.");
        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Received no input JSON data."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("getavatarpic: Error: Received no input JSON data.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    