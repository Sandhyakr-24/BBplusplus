<?php

/**
 * Service API:  updateprofile
 * File name: updateprofile.php
 * Author: Suresh Kodoor
 * 
 * JSON Payload:
 * {
 * "name:"",
 * "deviceid":"",
 * "grade":"",
 * "schooltype:"1/0", 
 * "language":"",
 * "organization":"",
 * "avatarpic":"picture image as base64 encoded string"
 * }
 *    
 * JSON Response:
 * {
 *  "status":"failed/success",
 *  "description":"reason for failure"
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
        $grade        = $data->{'grade'};
        $schooltype   = $data->{'schooltype'};
        $language     = $data->{'language'};
        $organization = $data->{'organization'};
        $avatarpic    = $data->{'avatarpic'}; // The avatar image file as a base64 encoded string
        
        $childexists = checkIfNameAndDeviceRegistered($childname, $deviceid);
  
        if($childexists) {
        
           $childid = getChildIdByNameAndDevice($childname, $deviceid);
            
           if(!$childid) {
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Given combination of name and device ($childname, $deviceid) does not exist."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("updateprofile: Error: Given combination of name and device ($childname, $deviceid) does not exist.");
           }
           else {
               
               $objChild = getChildByChildId($childid); // get the current values so that update needs to be done only for those fields for which valid values are passed
               
               if(!$objChild) {
                   $responsedata = array(
                       'status' => "failed",
                       'description' => "Failed to fetch Child details"
                   );
                   $em = new exceptionMgr(" ");
                   $em->logInfo("updateprofile: Error: Failed to fetch Child details ");
               }
               else {
                   
                    $em = new exceptionMgr(" ");
                    $em->logInfo("updateprofile: objChild childid ".$childid);
                   
                    if(($grade != null) || ($grade != ''))
                        $objChild->setGradeName($grade);
                    if(($schooltype != null) || ($schooltype != ''))
                        $objChild->setSchoolTypeId($schooltype);
                    if(($language != null) || ($language != ''))
                        $objChild->setLanguageName($language);
                    if(($organization != null) || ($organization != ''))
                        $objChild->setOrg($organization);

                    $rtn = updateProfile($objChild);
               
      
                    if($rtn) {
        
                        if(($avatarpic == null) || ($avatarpic == '')) {
                            $avatarmsg = "Recieved empty string for avatar picture though.";
                            $em = new exceptionMgr(" ");
                            $em->logInfo("updateprofile: Received empty string for avatarpic.");
                        }
                        else {
                      
                            $rtnflg  = saveAvatarPic($avatarpic, $childid);
                            if(!$rtnflg) {
                                $avatarmsg = "Failed to save the avatar picture though.";
                                $em = new exceptionMgr(" ");
                                $em->logInfo("updateprofile: Error. Failed to save the avatar picture.");
                            }
                            else {
                                $avatarmsg = " ";
                            }
                        }
                        $responsedata = array(
                            'status' => "success",
                            'description' => " ".$avatarmsg
                        );
                     }
                     else {
                  
                        $responsedata = array(
                           'status' => "failed",
                          'description' => "updateprofie: Failed to update the profile data.".$avatarmsg
                        );
                     }
                 }
           }
        }
        else {
        
            $responsedata = array(
                'status' => "failed",
                'description' => "No account exists for the given name and deviceid"
            );
            $em = new exceptionMgr(" ");
            $em->logInfo("updateprofile: Error. No account exists for the given name and deviceid");
        }
    }
    else {
        $responsedata = array(
            'status' => "failed",
            'description' => "Received no input JSON data."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("updateprofile: Error. Received no input JSON data.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    