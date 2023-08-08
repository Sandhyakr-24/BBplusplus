<?php

if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
}

require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

    
class exceptionMgr extends Exception {

     private $logmgr;
     private $errmsg;
     
     function __construct($msg) {
     
         $this->logmgr = logMgr::getInstance();
         $this->errmsg = $msg;
     }
     
     public function handleError() {

      global $cfg_loggingOn;
      global $cfg_ShowDetailedErrorMsgOnScreen;
      
      // this->getCode() - get the Error code, if any was passed with the message
		// this->getTraceAsString() - get the stack trace
		// this->getLine() - line of code
		// this->getFile() - file in which error occured
		// this->getMessage() - message passed with the exception

	    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile().' : '.$this->getMessage().': '.$this->errmsg;

        // log the message to the logfile
        
        $LOG_ENTRY_ID = 'NO_LOG';
        
        if($cfg_loggingOn) {
          $LOG_ENTRY_ID = $this->logmgr->writeToLog("EMRP",$errorMsg,logMgr::$LG_ERROR);
        }
        
        // error message for the end-user
        $alertmsg = "Application has encountered a temperory error condition. Please login again to your account. (LOG_ENTRY_ID:".$LOG_ENTRY_ID.")";

        if($cfg_ShowDetailedErrorMsgOnScreen) {
          $arrErrorMsg['detailed_msg'] = "Error Details: <br/><br />".$errorMsg."<br/><br />"."(Error details will not be displayed on the Production environment. Will only be written to the LOG file.)";
        }
        
        $arrErrorMsg['error_msg'] = $alertmsg;
        //$error_view_displaymsg = new error_view_displaymsg();
        //$error_view_displaymsg->show($arrErrorMsg);
        // exit();
       
        // Show a javascript alert to the end-user
        echo "<script>";
        echo "alert('$alertmsg');";
        echo "</script>";
      
	 }
	 
	 public function logInfo($msg) {
	     
	     global $cfg_loggingOn;
	     
	     // log the message to the logfile
	     
	     $LOG_ENTRY_ID = 'NO_LOG';
	     
	     if($cfg_loggingOn) {
	         $LOG_ENTRY_ID = $this->logmgr->writeToLog("EMRP",$msg,logMgr::$LG_INFO);
	     }
	 }
}
?>
