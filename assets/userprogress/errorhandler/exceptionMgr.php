<?php

if(!isset($_SESSION['ABSAPP_BASE_DIR'])) {
		echo "Invalid Session";
		exit();
}

require_once($_SESSION['ABSAPP_BASE_DIR']."/app/boot/checksandincludes.php");

    
class exceptionMgr extends Exception {

     private $logmgr;
     private $errmsg;
     
     function __construct($msg) {
     
         $this->logmgr = logMgr::getInstance();
         $this->errmsg = $msg;
     }
     
     public function handleError() {

      /*global $cfg_loggingOn;
      
      // this->getCode() - get the Error code, if any was passed with the message
		// this->getTraceAsString() - get the stack trace
		// this->getLine() - line of code
		// this->getFile() - file in which error occured
		// this->getMessage() - message passed with the exception

	    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().' : '.$this->getMessage().': '.$this->errmsg;

        // log the message to the logfile
        
        $LOG_ENTRY_ID = 'NO_LOG';
        
        if($cfg_loggingOn) {
          $LOG_ENTRY_ID = $this->logmgr->writeToLog("ABS",$errorMsg,logMgr::$LG_ERROR);
        }
        
        // error message for the end-user
        
        // $alertmsg = "Application has encountered a temperory error condition. Please login again to your account. (LOG_ENTRY_ID:".$LOG_ENTRY_ID.")";
        
        /*
        // Show a javascript alert to the end-user
        echo "<script>";
        echo "alert('$alertmsg');";
        echo "</script>";
        */
	 }
	 public function logInfo($msg) {
	     
	     /*global $cfg_loggingOn;
	     
	     
         // log the message to the logfile
	     
	     $LOG_ENTRY_ID = 'NO_LOG';
	     
	     if($cfg_loggingOn) {
	         $LOG_ENTRY_ID = $this->logmgr->writeToLog("ABS",$msg,logMgr::$LG_INFO);
	     }*/
	 }
}
?>