<?php
/**
 * Service API:  updateavatarpic
 * File name: updateavatarpic.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "name:"",
 * "deviceid":"",
 * "avatarpic":"picture image as base64 encoded string"
 * }
 *    
 * JSON Response:
 * {
 *  "status":"failed/success",
 *  "description":"reason for failure/success message"
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
   
    // get posted data
    // $jsonstring = $_GET['json'];
    // Using file_get_contents instead to get the content to a string. 
    // Note: json_decode works only with UTF-8 encoded strings. 
    // So, if not UTF-8 encoded, use the function  $jsonstring = utf8_encode($jsonstring) before calling json_decode
    $jsonstring = file_get_contents("php://input");
    
    $data = json_decode($jsonstring); 
    
  
    if($data) {
        $childname = $data->{'name'};
        $deviceid = $data->{'deviceid'};
        $avatarpic = $data->{'avatarpic'}; // The avatar image file as a base64 encoded string
  
        $childexists = checkIfNameAndDeviceRegistered($avatarname, $deviceid);
        
        if($childexists) {
        
           $childid = getChildIdByNameAndDevice($childname, $deviceid);
                          
           if(!$childid) {
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Given combination of name and device ($childname, $deviceid) does not exist."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("updateavatarpic: Error: Given combination of name and device ($childname, $deviceid) does not exist.");
           }
           else {
               
               $childid = getChildIdByNameAndDevice($avatarname,$deviceid);
                              
               if(!$childid) {
                   $responsedata = array(
                       'status' => "failed",
                       'description' => "Given combination of name and device ($childname, $deviceid) does not exist."
                   );
                   $em = new exceptionMgr(" ");
                   $em->logInfo("updateavatarpic: Error: Given combination of name and device ($childname, $deviceid) does not exist.");
               }
               else if(($avatarpic == null) || ($avatarpic == '')) {
                      $avatarmsg = "Received no data for the avatarpic.";
                      $em = new exceptionMgr(" ");
                      $em->logInfo("updateavatarpic: Error: Received no data for the avatarpic.");
               }
               else {
                      $rtnflg  = saveAvatarPic($avatarpic, $childid);
                      if(!$rtnflg) {
                          $avatarmsg = " Failed to save the avatar picture.";
                          $em = new exceptionMgr(" ");
                          $em->logInfo("updateavatarpic: Error: Failed to save the avatar picture.");
                      }
                      else {
                          $avatarmsg = " ";
                      }
               }
               $responsedata = array(
                    'status' => "success",
                    'description' => " "
               );
            }
        }
        else {
        
            $responsedata = array(
                'status' => "failed",
                'description' => "Input parameters missing."
            );
            $em = new exceptionMgr(" ");
            $em->logInfo("updateavatarpic: Error: Input parameters missing.");
        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Received no input JSON data."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("updateavatarpic: Error: Received no input JSON data.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    