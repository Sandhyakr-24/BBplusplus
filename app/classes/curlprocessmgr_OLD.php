<?php

/**
* Ref: http://www.php.net/manual/en/function.curl-setopt.php
* Examples: 
* http://php.net/manual/en/curl.examples-basic.php
* https://www.startutorial.com/articles/view/php-curl
*
*/

include '../../config/appconfig.php';
    
class curlprocessmgr {
    
    private $ekstepapi_url;
    
    function __construct() {
        
        global $cfg_ekstepapi_url;
        
        $this->ekstepapi_url  = $cfg_ekstepapi_url;

    }
    
    function syncToEkStep($jsondata) {
        
        global $cfg_ekstepapi_token;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->ekstepapi_url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);    // return response as a variable (instead of printing the output)
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        
        // HTTP HEADER Fields : curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $headers = array(
            "Content-type: application/json; charset=\"utf-8\"",
            "Accept: application/json",
            "Authorization: Bearer ".$cfg_ekstepapi_token);
       
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Set the POST variables
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata); 
        
        // Execute curl
        $respjson = curl_exec($ch);
        
        $curl_errno = curl_errno($ch);
        
        if((!$respjson) || ($curl_errno > 0)) {
            
           $curl_error = curl_error($ch);
           $exceptionMgr = new exceptionMgr($curl_error);
           $exceptionMgr->handleError();
           $rtnflag = false;
        }
        else  {
           $rtnflag = true;
           $responsedata = json_decode($respjson);
        }
        
        //close the curl handle
        curl_close($ch); 
        
        return $rtnflag;
    }
}


?>