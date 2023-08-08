<?php

/**
* Ref: http://www.php.net/manual/en/function.curl-setopt.php
* Examples: 
* http://php.net/manual/en/curl.examples-basic.php
* https://www.startutorial.com/articles/view/php-curl
*
*/

require_once("/var/www/vhosts/kodvin.com/httpdocs/abs/config/appconfig.php");
    
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
        
        $authorizationtoken = "Authorization: Bearer ".$cfg_ekstepapi_token; 

        $header_array = array(
            "Content-type: application/json",
            "cache-control: no-cache",
            "Accept: application/json");

        $header_array[] = "Authorization: Bearer ".$cfg_ekstepapi_token;

        //echo "\nHEADERS:\n";
        //print_r($header_array);
        //echo "\nJSON Object:\n".$jsondata;
      

        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
        
        // Set the POST variables
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata); 
        
        // Execute curl
        $curlresp = curl_exec($ch);
        $curlinfo = curl_getinfo($ch); 
        $curl_errno = curl_errno($ch);

        if($curlresp === false) {  // check if 'identical' (not just boolean false). Ref: http://php.net/manual/en/function.curl-exec.php

          $rtnflag = false;
          $curl_error = curl_error($ch);
          $rtnmsg  = "No curl data returned for the URL:".$this->ekstepapi_url." .\n Curl output is 'false'. \n Curl error no: ".$curl_errno.". Curl error message:".$curl_error;
        }
        else if($curlinfo['http_code'] != 200) {
        
          $rtnflag = false;
          $curl_error = curl_error($ch);
          $rtnmsg  = "No curl data returned for the URL:".$this->ekstepapi_url.".\nReturned HTTP_CODE: ".$curlinfo['http_code']."\nCurl error no: ".$curl_errno.". Curl error message:".$curl_error;
        }
        else  {
           $rtnmsg = "\nSuccessfully synced the data to EkStep!\n";
           $rtnflag = true;
           //echo "\nRESPONSE FROM EkSTEP:\n";
           //print_r($curlresp);
        }
        
        //close the curl handle
        curl_close($ch); 
        
        //$exceptionMgr = new exceptionMgr($rtnmsg);
        //$exceptionMgr->handleError();
        //echo $rtnmsg;
        return $rtnflag;
    }
}


?>
