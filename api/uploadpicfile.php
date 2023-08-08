<?php
/**
 * Service API:  uploadpicfile
 * File name: uploadpicfile.php
 * Author: Suresh Kodoor
 * 
 * This API is provided to upload the avatar picture by uploading image file instead of using 
 * updataavtarpic API where the image is to be sent by base64 encoded String. The uploadpicfile API
 * will receive file as multi-part form data.
 * 
 * Input is in multipart format, not JSON object
 * The data encoding type, enctype, MUST be specified as below 
 * form enctype="multipart/form-data"  method="POST"
 * input name="avatarpicfile" type="file" />
 * 
 * Sample client file to test the uploadpicfile API:
 * <form enctype="multipart/form-data" action="http://www.kodvin.com/abs/uploadpicfile" method="POST">
 * <input type="hidden" name="access_token" value="5a5786567091e" />
 * Send this file: <input name="avatarpicfile" type="file" />
 * <input type="submit" value="Send File" />
 * </form>
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
   
    global $cfg_valid_imagefile_extensions, $cfg_avatarpics_dir;

    // print_r($_FILES); 
    $clientfilename = $_FILES['avatarpicfile']['name'];
    $childname = $_POST['name'];
    $deviceid = $_POST['deviceid'];
    $server_temp_filename = $_FILES['avatarpicfile']['tmp_name'];

 
    if($clientfilename != '') {
  
        $childexists = checkIfNameAndDeviceRegistered($childname, $deviceid);
        
        if($childexists) {
        
           $childid = getChildIdByNameAndDevice($childname,$deviceid);
                          
           if(!$childid) {
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Given combination of name and device ($childname, $deviceid) does not exist."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("uploadpicfile: Error: Given combination of name and device ($childname, $deviceid) does not exist.");
           }
           else {
               
               if(($server_temp_filename == null) || ($server_temp_filename == '')) {
                      $avatarmsg = "File upload failed.";
                      $em = new exceptionMgr(" ");
                      $em->logInfo("uploadpicfile: Error: No file uploaded. FILES['avatarpicfile']['tmp_name'] is empty.");
               }
               else {
                   
                      $createddatetime = time(); // time() returns current UNIX timestamp (current time measured in the number of seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
                      $picfilename = 'pic_'.$childid.'_'.$createddatetime;
                      $picfilefullpath = $_SESSION['ABSAPP_BASE_DIR'].'/'.$cfg_avatarpics_dir.'/'.$picfilename;
                      
                      try { 

                        $rtn =  move_uploaded_file($server_temp_filename, $picfilefullpath); 
  
                      	if(!$rtn) { 
                          $avatarmsg = "File upload failed.";
                          $responsedata = array(
                              'status' => "failed",
                              'description' => $avatarmsg
                          );
                          $em = new exceptionMgr(" ");
                          $em->logInfo("uploadpicfile: Failed to upload the file. move_upload_file returned false. tempfile: ".$server_temp_filename." targetfilename: ".$picfilefullpath);
                        }
                      	else {
                          $avatarmsg = " ";
                          $responsedata = array(
                          'status' => "success",
                          'description' => " "
                          );
                          
                          // update the pic filename in the database
                          updateAvatarpicFilenameByChildId($childid,$picfilename);
                          
                          $em = new exceptionMgr(" ");
                          $em->logInfo("uploadpicfile: Success. Saved filename: ".$picfilefullpath);
                        }
                      }
                      catch(Exception $e) {
                          $avatarmsg = "File upload failed. Exception: ".$e->toString();
                          $responsedata = array(
                              'status' => "failed",
                              'description' => $avatarmsg
                          );
                          $em = new exceptionMgr(" ");
                          $em->logInfo("uploadpicfile: Failed to upload the file. Exception: ".$e->toString());
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
            $em->logInfo("uploadpicfile: Error: No account exists for the given name and deviceid");
        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Received no image file data. FILES['avatarpicfile']['name'] is empty"
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("uploadpicfile: Error: Received no image file data. FILES['avatarpicfile']['name'] is empty.");
    }
    
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    
