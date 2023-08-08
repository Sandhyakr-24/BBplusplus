<?php
	session_start();
	
/**
* Class: smsmanager
*
* Class to manage SMS communication.
* 
*
*/

    if(!isset($_SESSION[SMAPP_BASE_DIR])) {
		echo "smsMgr: Unauthorised Access";
		exit();
	 }
	 
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/views/includes/include_directory_paths.php");
    
   class smsmanager {
	
	private $smsprovider;
	private $smshandler;
	private $smsparameter;
    
      function __construct() {
	
	 global $cfg_smsprovider;
	 global $cfg_smshandler_param;
	 
	 global $cfgsch_smsprovider;
	 global $cfgsch_smshandler_param;
	 
	 
	 if($cfgsch_smsprovider==""){
		$this->smsprovider = $cfg_smsprovider;
		$this->smsparameter= $cfg_smshandler_param;
	 }
	 else{
		$this->smsprovider = $cfgsch_smsprovider;
		$this->smsparameter = $cfgsch_smshandler_param;
	 }
		
	 $className = $this->smsprovider."_handler";
	 $this->smshandler = new $className();
	 
      }
            
      function sendSms($message, $to) {
	        
		$status = $this->smshandler->sendSms($message, $to,$this->smsparameter);
		return $status;       
      }
      
  }
?>