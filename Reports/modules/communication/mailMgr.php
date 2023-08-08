<?php
	session_start();
	
/**
* Class: mailMgr
*
* Class to manage email communication.
* This class used PHPMailer third-party utility class (class.phpmailer.php)
*
*/

    if(!isset($_SESSION[SMAPP_BASE_DIR])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/views/includes/include_directory_paths.php");
    
    // require_once($_SESSION[SMAPP_BASE_DIR]."/modules/communication/class.phpmailer.php");

    class mailMgr {
    
      private $PHPMailer;
      
      function __construct() {
      
         $this->PHPMailer = new PHPMailer(true);   // false - dont throw any external exceptions (false option not working)
         
         $this->PHPMailer->Host     = $cfg_mail_Host;
         $this->PHPMailer->Mailer   = $cfg_mail_Mailer;    // Method to send mail. Allowed values are "mail", "sendmail", or "smtp"
         $this->PHPMailer->Username = $cfg_smtp_username;  // SMTP Server Username
         $this->PHPMailer->Password = $cfg_smtp_password;  // SMTP Server password
         
         if($cfg_smtp_Sender != '') {
           $this->PHPMailer->Sender = $cfg_smtp_Sender;
         }
         
         if($cfg_htmlformat) {    // true to send the emails in HTML format
             $this->PHPMailer->IsHTML(true);
         }
         
         if($cfg_sendmail_path != '') {
             $this->PHPMailer->Sendmail =  $cfg_sendmail_path;
         }
      }
      
      function setFromAddress($fromAddr, $fromName="") {
      
         $this->PHPMailer->setFrom($fromAddr, $fromName);
      }
      
      function setToAddress($address) {
      
         $this->PHPMailer->AddAddress($address);
      }
      
      function setCCAddress($address) {

            $this->PHPMailer->AddCC($address);
      }

      function setBCCAddress($address) {

          $this->PHPMailer->AddBCC($address);
      }
      
      function setReplyTo($address) {
      
         $this->PHPMailer->AddReplyTo($address);
      }
      
      function setSubject($subject) {
      
         $this->PHPMailer->Subject = $subject;
      }
      

      function setBody($msgbody) {
      
         if($cfg_htmlformat) {
            $this->PHPMailer->MsgHTML($msgbody);
         }
         else {
            $this->PHPMailer->Body = $msgbody;
            $this->PHPMailer->AltBody = $msgbody; // for non-HTML clients
         }
      }
      
      function addAttachment($filename) {
      
         $this->PHPMailer->addAttachment($filename);
      }
      
      function AddStringAttachment($string, $filename, $encoding = 'base64', $type = 'application/octet-stream') {

         $this->PHPMailer->AddStringAttachment($string, $filename, $encoding, $type);
      }
      
      function sendEmail() {
      
         try {
           $rtn = $this->PHPMailer->Send();
           return $rtn;  // 'true' if success. 'false' if failed
         }
         catch(Exception $e) {
           return false;
         }
      }
  }
?>