<?php

require_once($_SESSION['ABSAPP_BASE_DIR']."/app/boot/checksandincludes.php");

function checkMatch($txtPassword, $encryptedPassword) {
	 
    if(crypt($txtPassword, $encryptedPassword) == $encryptedPassword){
       return true;
    }
    else {
       return false;
    }
}



function checkIfNameAndDeviceRegistered($childname,$deviceid){
    
    $servicefunctions_dao=new servicefunctions_dao();
    $rtn =  $servicefunctions_dao->checkIfNameAndDeviceRegistered($childname,$deviceid);
    return $rtn;
}



function getChildByNameAndDevice($childname, $deviceid) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $servicefunctions_dao->getChildByNameAndDevice($childname,$deviceid);
    
}


//to retrieve the user progress
function getChildUserProgress($childid) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $servicefunctions_dao->getChildUserProgress($childid);
    
}


?>