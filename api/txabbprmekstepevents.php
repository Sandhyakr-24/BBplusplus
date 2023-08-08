<?php

/**
 * Service API:  txekstepevents
 * File name: txekstepevents.php
 * Author: Suresh Kodoor
 * 
 * To test directly from the browser: use the following URL on the Browser (make sure _GET['json'] is used and file_get_contents line is commented
 * http://localhost/abs/api/txekstepevents.php?json=[{"access_token":"5a1e7376b70fa","id_game_play":"1","id_question":"100","ekstep_eventid":"OE_INTERACT","date_time_event":"2017:12:04:12:30:10","edata":{"eks":{"pageid":"15","type":"TOUCH","id":"DEVICE_BAK_BUTTON"}}}]
 * 
 * To test from Postman, comment out _GET['json'] and use file_get_contents
 * 
 * JSON Payload:
 * [                       // A JSON array of EkStep Telemetry event JSON objects 
 * {
 *    "objid":"",          // Identifier for this object/packet (can check the 'response' with this 'objid' to see if this object/packet is valid and successfully received)
 *    "avatarname":"",
 *    "deviceid":"",
 *    "id_game_play":"",
 *    "id_question":"",
 *    "ekstep_eventid":"",  // EkStep event ID. e.g OE_INTERACT 
 *    "date_time_event":"", // datetime of the event 
 *    "edata": {  // Event data for the EkStep event corresponding to the event specified by the 'ekstep_eventid'
 *        "eks":{
 *        }
 *    }
 * },
 * .
 * .
 * .
 * {
 *    "objid:"",
 *    "avatarname":"",
 *    "deviceid":"",
 *    "id_game_play":"",
 *    "id_question":"",
 *    "ekstep_eventid":"",
 *    "date_time_event":"",
 *    "edata": {
 *        "eks":{
 *        }
 *    }
 * }
 * ]
 *    
 * JSON Response:         // A JSON array of Response JSON objects (each response object corresponds to the update status of individual event telemetry data object) 
 * [
 * {
 *  "objid":"",
 *  "status":"failed/success",
 *  "description":"reason for failure/success message"
 * },
 * .
 * .
 * .
 * {
 *  "objid":"",
 *  "status":"failed/success",
 *  "description":"reason for failure/success message"
 * }
 * 
 * ]
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
    // echo "jsonstring:".$jsonstring;
    $jsondata_array = json_decode($jsonstring); 
    // print_r($jsondata_array);
    $responsedata_array = array();
    
    if(count($jsondata_array,1) == 0) {
   
        $responsedata = array(
            'objid' => '',
            'status' => "failed",
            'description' => "Received no input JSON data."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("txabbprmekstepevents: Error: Received no input JSON data."); 
    }
    else {
        
        foreach($jsondata_array as $data) {
     
            if($data) {
                $objid                 = $data->{'objid'};  
                $avatarname            = $data->{'avatarname'};
                $deviceid              = $data->{'deviceid'};
                $id_game_play          = $data->{'id_game_play'};
                $id_question           = $data->{'id_question'};
                $ekstep_eventid        = $data->{'ekstep_eventid'};
                $date_time_event       = $data->{'date_time_event'};
                
                $edata = $data->{'edata'};
                
                $childexists = checkIfNameAndDeviceRegistered($avatarname, $deviceid);
                
                if(!$childexists) {
                    $responsedata = array(
                        'objid' => $objid,
                        'status'       => "failed",
                        'description'  => "No account exists with the given name and deviceid"
                    );
                    $em = new exceptionMgr(" ");
                    $em->logInfo("txabbprmekstepevents: Error: No account exists with the given name and deviceid (".$avatarname.",".$deviceid.")");
                }
                else if(!$edata) {
                    
                    $responsedata = array(
                        'objid' => $objid,
                        'status' => "failed",
                        'description' => "JSON event object has empty 'edata{}'."
                    );
                    $em = new exceptionMgr(" ");
                    $em->logInfo("txabbprmekstepevents: Error: JSON event object has empty 'edata{}'."); 
                }
                else if(!($eks = $edata->{'eks'})) {
                    
                    $responsedata = array(
                        'objid' => $objid,
                        'status' => "failed",
                        'description' => "JSON event object has empty 'eks{}'."
                    );
                    $em = new exceptionMgr(" ");
                    $em->logInfo("txabbprmekstepevents: Error: JSON event object has empty 'eks{}'."); 
                }
                else {
        
                    $childid = getChildIdByNameAndDevice($avatarname,$deviceid);
                    
                    if($childid == null) {
                        $responsedata = array(
                            'objid' => $objid,
                            'status' => "failed",
                            'description' => "Could not retrive the Child ID for the given name and deviceid"
                        );
                        $em = new exceptionMgr(" ");
                        $em->logInfo("txabbprmekstepevents: Error: Could not retrive the Child ID for the given name and deviceid (".$avatarname.",".$deviceid.")");
                    }
                    else {
               
                        $objEkStepEventData = new ekstepeventdata();
               
                        $objEkStepEventData->setGamePlayId($id_game_play);
                        $objEkStepEventData->setChildName($avatarname);
                        $objEkStepEventData->setChildName($childid);
                        $objEkStepEventData->setDeviceId($deviceid);
                        $objEkStepEventData->setQuestionId($id_question);
                        $objEkStepEventData->setdateTimeEvent($date_time_event);
                        $objEkStepEventData->setEkStepEventId($ekstep_eventid);
                        
                        $objEkStepEventData->setedata($edata);
                        
                        $rtn = saveEkStepEventData($objEkStepEventData);
    
                        if($rtn) {
                            $responsedata = array(
                                'objid' => $objid,
                                'status' => "success",
                                'description' => ""
                            );
                        }
                        else {
                            $responsedata = array(
                                'objid' => $objid,
                                'status' => "failed",
                                'description' => "Failed to save the EkStep Event Data."
                            );
                            $em = new exceptionMgr(" ");
                            $em->logInfo("txabbprmekstepevents: Error: Failed to save the EkStep Event Data.");
                        }
                    }
                }
            }
            else {
        
                $responsedata = array(
                    'objid' => $objid,
                    'status' => "failed",
                    'description' => "Data missing for this JSON event object."
                );
                $em = new exceptionMgr(" ");
                $em->logInfo("txabbprmekstepevents: Error: Data missing for this JSON event object.");
             }
    
             array_push($responsedata_array,$responsedata);
        }
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata_array);
    
?>    