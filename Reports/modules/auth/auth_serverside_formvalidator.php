<?php
	session_start();

/**
* Server-side input form validation functions - for login forms
*
*/


    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
	 require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");
    

class auth_serverside_formvalidator {

   private $filters_loginform = array (

        "inputEmail" => FILTER_VALIDATE_EMAIL,
        "inputPassword" => FILTER_SANITIZE_STRING
   );

   private $filters_memberloginform = array (

        "inputEmail" => FILTER_VALIDATE_EMAIL,
        "inputPassword" => FILTER_SANITIZE_STRING
   );
   
   private $filters_forgotpasswordform = array (

        "inputEmail" => FILTER_VALIDATE_EMAIL
   );

   
   private $errormsg = array();

   function validateInputs_LoginForm($objCredentials) { // object passed by reference.
       // dont need '&' sign bcos it is the reference which is passed to the Helper function already
      
    
       $resultdata = filter_input_array(INPUT_POST, $this->filters_loginform);

       if(!$resultdata['inputEmail']) {
           $this->errormsg['inputEmail'] = 'MSGVAL_INVALID_USERNAME';
       }
       else {
           $objCredentials->setUsername((trim($resultdata['inputEmail'])));
       }
       
       if(!$resultdata['inputPassword']) {
           $this->errormsg['inputPassword'] = 'MSGVAL_INVALID_PASSWORD';
       }
       else {
           $objCredentials->setPassword(trim($resultdata['inputPassword']));
       }
       
      
       return $this->errormsg;
   }
    
 

   function validateInputs_ForgotPasswordForm(&$arrForgotPasswordCredentials) {

       $resultdata = filter_input_array(INPUT_POST, $this->filters_forgotpasswordform);

	   if(!$resultdata['inputEmail']) {
         $this->errormsg['inputEmail'] = 'MSGVAL_USERNAME';
       }
       else {
         $arrForgotPasswordCredentials['inputEmail'] = trim($resultdata['inputEmail']);
       }

	   return $this->errormsg;

   }

} // end of class
?>