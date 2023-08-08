<?php
	session_start();


    if(!isset($_SESSION[EMRP_BASE_DIR])) {
		echo "Unauthorised Access";
		exit();
	 }
	 require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");


    class auth_passwordmgr {
    
      private $logmgr;
      private $app_helper;
      private $app_user_dao;

      function __construct() {

         $logmgr = logMgr::getInstance();
         $this->app_helper = new app_helper();
         $this->app_user_dao = new app_user_dao();
      }
      
      // One-way encryption is used. So, the text password can not be retrieved
      // once it is encrypted. Only match can be checked with a given text password string.
      // So, for 'forgot password' functionality, reset the password to a new value than retrieving the old password.
      function encryptPassword($txtPassword) {
      
          $password_encrypted =  crypt($txtPassword);
          return $password_encrypted;
      }
      
      function checkMatch($txtPassword, $encryptedPassword) {
      
          if(crypt($txtPassword, $encryptedPassword) == $encryptedPassword){
             return true;
          }
          else {
             return false;
          }
       }
       
       // To generate password string for resetting user password by Admin
       function generatePassword() {
       
         $txtPassword = mt_rand(); // create a random number
         return($txtPassword);
       }

       
      // check if the email-password combination is valid
      // return 'true' if valid. return 'false' otherwise
      // if the credentials are valid, change the password
      
      function changeUserPassword($user_id, $email_input, $current_password_input, $new_password_input) {
      
         $email = $this->app_user_dao->getUserEmailIdByUserId($user_id);

         if(!($email === trim($email_input))) {
           return false;  // email input and the email on the DB for this user_id do not match
         }

         $password_stored = $this->app_user_dao->getPasswordByUserId($user_id);
         $password_valid = $this->checkMatch(trim($current_password_input), $password_stored);
         if(!$password_valid) {
           return false; // password do not match
         }
         
         // credentials valid. Change password.
         // encrypt the password
         $new_password_encrypted = $this->encryptPassword(trim($new_password_input));

         // update the user password
         $this->app_user_dao->updatePassword($user_id, $new_password_encrypted);
         
         return true;
      }
      
      function resetForgotPassword($user_id,$new_password_input){

         $new_password_encrypted = $this->encryptPassword(trim($new_password_input));

         // update the user password
         if($user_id != '') {
            $this->app_user_dao->updatePassword($user_id, $new_password_encrypted);
         }
         
         return true;
      }
    }
?>