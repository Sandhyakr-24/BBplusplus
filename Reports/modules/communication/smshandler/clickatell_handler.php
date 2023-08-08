<?php
	session_start();
	
 if(!isset($_SESSION[SMAPP_BASE_DIR])) {
		echo "clickatellDriver: Unauthorised Access";
		exit();
	 }
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/views/includes/include_directory_paths.php");
    
   class clickatell_handler {
    
               
        
        function sendSms($message, $to,$smsparameter){
		
            //$ret = file("http://api.clickatell.com/http/sendmsg?api_id=".$smsparameter['api_id']."&user=".$smsparameter['username']."&password=".$smsparameter['password']."&to=".$to."&text=".$message);
	   
	    $ret = file("http://api.mVaayoo.com/mvaayooapi/MessageCompose?user=suresh.kodoor@trizile.com:sureshk&senderID=TEST SMS&receipientno=9986340178&dcs=0&msgtxt=This is Test message&state=4");

	    // 

	    $send = split(":",$ret[0]);
	    
            if($send[0] == "ID"){
		return true;
	    }
            else{
                return false;
            }
        }
    
   }        //end of class
