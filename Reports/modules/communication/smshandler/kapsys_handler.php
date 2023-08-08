<?php
	session_start();
	
 if(!isset($_SESSION[SMAPP_BASE_DIR])) {
		echo "clickatellDriver: Unauthorised Access";
		exit();
	 }
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/views/includes/include_directory_paths.php");
    
   class kapsys_handler {
    
    
        
        function sendSms($message, $toArray,$smsparameter){
            
            $to = "";
            $i=1;
            //echo count($toArray);
            foreach($toArray as $objUser){
                //echo $objUser->getPhoneCell();
                 if($objUser->getPhoneCell()){
                   if($i%300 !=0){
                       $to .= $objUser->getPhoneCell().",";
                       if($i==count($toArray)){
                        $to=rtrim($to,',');
                        $this->sendSMSToLIMITEDPhoneNumbers($message, $to,$smsparameter);
                        
                       }
                   }  
                   else{
                       $to .= $objUser->getPhoneCell();
                       $this->sendSMSToLIMITEDPhoneNumbers($message, $to,$smsparameter);
                       $to = "";
                   }
                   
                   $i++;
                 }
                 
            }
            
            
            
	
            
        }
        
        function sendSMSToLIMITEDPhoneNumbers($message, $to,$smsparameter){
            
            $url="http://203.129.203.254/sms/user/urllongsms1.php?username=".$smsparameter['username']."&pass=".$smsparameter['password']."&senderid=".$smsparameter['senderid']."&message=".$message."&dest_mobileno=".$to."&response=Y";
            $request="username=".$smsparameter['username']."&pass=".$smsparameter['password']."&senderid=".$smsparameter['senderid']."&message=".$message."&dest_mobileno=".$to;
           
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); //set the url
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
            curl_setopt($ch, CURLOPT_POST, 1); //set POST method
            curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
            if(curl_exec($ch) === false)
            {
                return false;
            }
            else
            {
                return true;
            }
            
            curl_close($ch); //close the curl handle
            
        }
    
   }        //end of class
