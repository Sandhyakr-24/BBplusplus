<?php
/**
 * Service API:  rxabbchmgetgamemasterdata
 * File name: rxabbchmgetgamemasterdata.php
 * Author: Suresh Kodoor
 * 
 * NO Input
 *    
 * JSON Response:
 * {
 * "status":"failed/success",
 * "description":"reason for failure, if status is 'failed'",
 * "games": [
 *   {"id_game":"",
 *    "game_description":"",
 *    "grade":"",
 *    "gametoopen":"",
 *    "prerequisitegame":""
 *   }
 * ]
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
    

    $arrresp = getCHMgamemasterdata();
    
    if($arrresp != null) {
        
        $array_games = array();
        
        for($i = 0; $i < sizeof($arrresp); $i++) {
            
            $array_games[$i]['id_game'] = $arrresp[$i]['id_game'];
            $array_games[$i]['game_description'] = $arrresp[$i]['game_description'];
            $array_games[$i]['grade'] = $arrresp[$i]['gradedescr'];
            $array_games[$i]['gametoopen'] = $arrresp[$i]['gametoopen'];
            $array_games[$i]['prerequisitegame'] = $arrresp[$i]['prerequisitegame'];

        }
        
        $responsedata = array(
            'status' => "success",
            'message' => "gamemasterdata has been successfully retrieved."
        );
   
        $responsedata['games'] = $array_games;
    }
    else {
        $responsedata = array(
            'status' => "failed",
            'description' => "Failed to retrive gamemasterdata"
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("rxabbchmgetgamemasterdata: Error: Failed to retrive gamemasterdata");
    }
    
   
    header('Content-type: application/json');
    echo json_encode($responsedata);
    
?>    