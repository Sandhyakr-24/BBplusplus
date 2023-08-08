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



function login($name,$deviceid){
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $childid = $servicefunctions_dao->getChildIdByNameAndDevice($name, $deviceid);
  
    if($childid == null) return false;  // authentication failed
    else return $childid; // authentication success. Return id_child
     
}

function createAccessToken(){
    
    return $access_token = uniqid();
}

function checkIfAccessTokenExistsForChildForDevice($childid,$deviceid){
   
    $servicefunctions_dao=new servicefunctions_dao();

    $rtn = $servicefunctions_dao->checkIfAccessTokenExistsForChildForDevice($childid,$deviceid);
    return $rtn;
}

function updateAccessToken($childid,$deviceid,$access_token, $created_datetime){
   
    $servicefunctions_dao=new servicefunctions_dao();
    $servicefunctions_dao->updateAccessToken($childid,$deviceid,$access_token, $created_datetime);
}

function saveNewAccessTokenForChildForDevice($childid,$deviceid,$access_token,$created_datetime){
   
    $servicefunctions_dao=new servicefunctions_dao();
    $servicefunctions_dao->saveNewAccessTokenForChildForDevice($childid,$deviceid,$access_token,$created_datetime);
}

function checkIfValidAccessToken($access_token){
    
    $servicefunctions_dao=new servicefunctions_dao();
    $rtn = $servicefunctions_dao->checkIfValidAccessToken($access_token); 
    return $rtn;
}

function checkIfNameAndDeviceRegistered($childname,$deviceid){
    
    $servicefunctions_dao=new servicefunctions_dao();
    $rtn =  $servicefunctions_dao->checkIfNameAndDeviceRegistered($childname,$deviceid);
    return $rtn;
}

function getChildIdByAccessToken($access_token){
   
    $servicefunctions_dao=new servicefunctions_dao();
    return $childid = $servicefunctions_dao->getChildIdByAccessToken($access_token);   
    
}

function getChildIdByNameAndDevice($name,$deviceid) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $childid = $servicefunctions_dao->getChildIdByNameAndDevice($name,$deviceid);   
}

function getAccessTokenForChildForDevice($childname,$deviceid){
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $token = $servicefunctions_dao->getAccessTokenForChildForDevice($childname,$deviceid);
    
}

function getChildByNameAndDevice($childname, $deviceid) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $servicefunctions_dao->getChildByNameAndDevice($childname,$deviceid);
    
}

function getChildByChildId($childid) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $servicefunctions_dao->getChildByChildId($childid);
    
}

function getChildByAccessToken($accesstoken) {
    
    $servicefunctions_dao=new servicefunctions_dao();
    return $servicefunctions_dao->getChildByAccessToken($accesstoken);
    
}

function registerNewChild($objChild){ 
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->insertChild($objChild);
    
    if($rtn) {
        return true;  
    }
    else {
        return false;
    }
}

function updateProfile($objChild) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->updateProfile($objChild);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}

function saveAvatarPic($base64imagestring,$child_id) {
    
    global $cfg_valid_imagefile_extensions, $cfg_avatarpics_dir;
    
    if(!$child_id) return false;
    
    $createddatetime = time(); // time() returns current UNIX timestamp (current time measured in the number of seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)
    
    $picfilename = 'pic_'.$child_id.'_'.$createddatetime;
    $picfilefullpath = $_SESSION['ABSAPP_BASE_DIR'].'/'.$cfg_avatarpics_dir.'/'.$picfilename;
    
    // convert the JSON base64 encoded string to an image file. Returns. 
    $rtn = file_put_contents($picfilefullpath, base64_decode($base64imagestring));
    
    // file_put_contents returns number of chars written to the file in case of success OR 'false' if failed
    if($rtn !== false) {
        $servicefunctions_dao = new servicefunctions_dao();
        $servicefunctions_dao->updateAvatarpicFilenameByChildId($child_id,$picfilename);
    }
    return $rtn;
           
}

function updateAvatarpicFilenameByChildId($child_id,$picfilename) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    $servicefunctions_dao->updateAvatarpicFilenameByChildId($child_id,$picfilename);
}


function getAvatarpicEncodedStringByChildId($child_id){
    
    global $cfg_avatarpics_dir;
  
    $servicefunctions_dao=new servicefunctions_dao();
    $picfilename = $servicefunctions_dao->getAvatarpicFilenameByChildId($child_id);
 
    if(($picfilename == null) || ($picfilename == ''))
        return '';
    
    $picfilefullpath = $_SESSION['ABSAPP_BASE_DIR'].'/'.$cfg_avatarpics_dir.'/'.$picfilename;
    $imagedata = file_get_contents($picfilefullpath);
    $base64imagestring = base64_encode($imagedata);
    return $base64imagestring;
}

function saveGameplaydetail($objGameplaydetail){
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->insertGameplaydetail($objGameplaydetail);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}

function saveCHMGameplaydetail($objGameplaydetail){
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->insertCHMGameplaydetail($objGameplaydetail);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}

function getGameplaydetailByGameplaydetailId($gamedetailid) {

    $servicefunctions_dao = new servicefunctions_dao();
    
    $objGameplaydetail = $servicefunctions_dao->getGameplaydetail($gamedetailid);
    return $objGameplaydetail;
}

function saveGameplay($objGameplay){
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->insertGameplay($objGameplay);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}

function saveCHMGameplay($objGameplay){
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $rtn = $servicefunctions_dao->insertCHMGameplay($objGameplay);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}


function getGameplayByGameplayId($gameplayid) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $objGameplay = $servicefunctions_dao->getGameplay($gameplayid);
    return $objGameplay;
}

function saveEkStepEventData($objEkStepEventData){
    
    $ekstepevents_dao = new ekstepevents_dao();
    
    $rtn = $ekstepevents_dao->insertEkStepEventData($objEkStepEventData);
    
    if($rtn) {
        return true;
    }
    else {
        return false;
    }
}

function saveCHMwalletscore($childid, $score, $datetime_lastupdated) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $scoreexists = getChmwalletscore($childid); // If the walletscore record already exists for this Child
    
    $rtn = true;
    
    if($scoreexists) 
        $rtn = $servicefunctions_dao->updateCHMwalletscore($childid, $score, $datetime_lastupdated);
    else
        $rtn = $servicefunctions_dao->insertCHMwalletscore($childid, $score, $datetime_lastupdated);
    
    if($rtn)  return true;
    else      return false;
    
}

function getCHMwalletscore($childid) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $arrResp = $servicefunctions_dao->getCHMwalletscore($childid);
    return $arrResp;
}

function getCHMgamemasterdata() {
    
    $servicefunctions_dao = new servicefunctions_dao();
    
    $arrResp = $servicefunctions_dao->getCHMgamemasterdata();
    return $arrResp;
}

/*
 Get the 'district' corresponding to the geo-code (lattitude and longitude)

Using mapmyindia API
   Ref: http://www.mapmyindia.com/api/advanced-maps/doc/reverse-geocoding-api
   Example:
     Input: https://apis.mapmyindia.com/advancedmaps/v1/<licence_key>/rev_geocode?lat=26.5645&lng=85.9914

Using google API
   Ref: https://developers.google.com/maps/documentation/geocoding/start?csw=1
   URL: https://maps.google.com/maps/api/geocode/json?latlng=26.5645,85.9914&key=AIzaSyARKQR2KJgN1qYCiZ9cBnGMu3YzhHu2YEE
*/

function getDistrictFromGeocode($lat, $lng) {


    global $cfg_reversegeocodeapi_provider, $cfg_reversegeocodeapiurl_mapmyindia, $cfg_key_googleapi, $cfg_reversegeocodeapiurl_google;

    $district = "";
    
    // Lattitude must be between -90 and 90. Longitude must be between -180 and 180
    if(!is_numeric($lat) || !is_numeric($lng) ) { // If not a valid number (e.g 12, -12, 12.1 etc), return
        echo "latitude/longitude values are not numeric. Lat: ".$lat." Long: ".$lng;
        return $district;
    }
    else if(((float)$lat > 90) || ((float)$lat < -90) ){
        echo "latitude not between -90 and 90. Lat: ".$lat." Long:".$lng;
        return $district;
    }
    else if(((float)$lng > 180) || ((float)$lng < -180) ) {
        echo "longitude not between -180 and 180. Lat: ".$lat." Long:".$lng;
        return $district;
    }
    else;
    
        
        
    //echo "reverse geo-code API provider name:".$cfg_reversegeocodeapi_provider;
    switch($cfg_reversegeocodeapi_provider) {
        
        case 'google':
            
            $url = $cfg_reversegeocodeapiurl_google.$lat.",".$lng."&key=".$cfg_key_googleapi;
            //echo " url: ".$url;
            $data = json_decode(file_get_contents($url));
            
            if (!isset($data->results[0]->address_components)){
                echo "getDistrictFromGeocode: address_components empty";
                $district = "";
                break;
            }
            
            $numberof_addresscomponents = sizeof($data->results[0]->address_components);
            for($i=0; $i < $numberof_addresscomponents; $i++) {
                
                if($data->results[0]->address_components[$i]->types[0] == "locality") {
                    $district =   $data->results[0]->address_components[$i]->long_name;
                    break;
                }
            }

            break;
            
            
        case 'mapmyindia':
            
            $url = $cfg_reversegeocodeapiurl_mapmyindia."lat=".$lat."&lng=".$lng;
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            
            $resjson = json_decode($result, true);
            //$errors = curl_error($curl);
            //echo $errors;
            
            curl_close($curl);
            
            //print_r($resjson);
            //print_r($resjson['results']);
            // echo "District:".$resjson['results'][0]['district'];
            
            $district = $resjson['results'][0]['district'];
            break;
    }

    return $district;
}

function updateDistrict($district,$childid) {
    
    $servicefunctions_dao = new servicefunctions_dao();
    $servicefunctions_dao->updateDistrict($district, $childid);
}

?>