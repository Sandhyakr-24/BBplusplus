<?php
    session_start();

/**
* Class: auth_dao
*
* Data access layer functions for authentication module
*
*/

    if(!isset($_SESSION[EMRP_BASE_DIR])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
 	 }

 	 require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");


    class auth_dao {

      private $dbh; // dbhandler object
      private $logmgr;
      private $app_dao;
      
      function __construct() {
        $this->dbh = emrp_dbhandler::getInstance();
        $this->logmgr = logMgr::getInstance();
        $this->app_dao = new app_dao;
      }
      
      // checking the user credential. check if the email provided by the user is valid
      function isEmailValid($email, $library_id) {

        $query = "SELECT count(email_id) FROM user_tbl WHERE email_id = '$email' ";

		  $result = $this->dbh->executeQuery($query);

		  if($result){
			     if($this->dbh->getNumRows() > 0 ) {
				    $arrResult = $this->dbh->fetchAssocList();
        		    if($arrResult == null) {
				       throw new exceptionMgr("Failed to check if EmailId exist: query: ".$query);
				    }
				    else {
                         if($arrResult[0]['count(email_id)'] >= 1) {
			                 return true;  // emailId exists
			             }
			             else {
                             return false; // emailId does not exist. authentication fails
			             }
			        }
			     }
			     return false;
		  }
          else {
				 throw new exceptionMgr("Failed to check if EmailId exists: query: ".$query);
		  }
      }
      
     
      function confirmUser($user_id,$email_id){
	
	       $additional_condition=" and email_id='".$email_id."'";
	
	       $arrResult = $this->dbh->readRecords('user_tbl','user_id','user_id',$user_id,$additional_condition);
	
	       if($arrResult[0]['user_id']=="")
	           return false;
	       else
	           return true;
	
      }
      
      
  } // end of class
      
?>