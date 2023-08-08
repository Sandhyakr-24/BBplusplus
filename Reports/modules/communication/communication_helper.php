<?php
	session_start();
	
/**
* Class: communication_helper
*
*/

    if(!isset($_SESSION[SMAPP_BASE_DIR])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[SMAPP_BASE_DIR]."/app/views/includes/include_directory_paths.php");


    class communication_helper {
    
      private $logmgr;
      private $mailmgr;
      
      function __construct() {
      
         $this->logmgr = logMgr::getInstance();
         $this->mailmgr = new mailMgr();
      }
      
     function sendEmail($to,$subject,$message,$fromEmailId,$attachment=array(),$is_attachment_array=0,$ccEmailId="", $ccAdmin=""){
	 
	 
	
	if(is_string($attachment))
		$attachment=trim($attachment," ");
	
	  if(strlen($attachment) || $is_attachment_array) {
	    
                if($is_attachment_array){
			
		       if($attachment["name"] != "")  
			{  
			$strFilesName = $attachment["name"];
			
			$strContent = chunk_split(base64_encode(file_get_contents($attachment["tmp_name"])));  
			
			if($ccAdmin)
			 $mail_headers .= 'Bcc: ' .$ccEmailId. "\r\n";			
			
			$mail_headers = "From:  <".$fromEmailId.">\r\n";
			$mail_headers .= "Reply-To: ".$fromEmailId."\r\n";
			$mail_headers .= "MIME-Version: 1.0\r\n";
			$mail_headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"\r\n\r\n";
			$mail_headers .= "This is a multi-part message in MIME format.\r\n";
			$mail_headers .= "--".$mime_boundary."\r\n";
			$mail_headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
			$mail_headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$mail_headers .= $message."\r\n\r\n";
			$mail_headers .= "--".$mime_boundary."\r\n";
			$mail_headers .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"\r\n"; // use different content types here
			$mail_headers .= "Content-Transfer-Encoding: base64\r\n";
			$mail_headers .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"\r\n\r\n";
			$mail_headers .= $strContent."\r\n\r\n";
			$mail_headers .= "--".$mime_boundary."--";
		     
			$email_message='';
			
			}
			
			$sent = mail( $to, $subject, $email_message, $mail_headers ) ;
			
		}else if( is_string($attachment)){
			$fileatt = "$_SESSION[SMAPP_BASE_DIR]/temp/$attachment";
			$fileatttype = "application/pdf";
			$fileattname = "$attachment";
		    
			$file = fopen( $fileatt, 'r+' );
			$data = fread( $file, filesize( $fileatt ) );
			fclose( $file );
		    	    
			//unlink($file);
			$data = chunk_split(base64_encode($data));
			$semi_rand = md5(time());
			$mime_boundary = $semi_rand;
		     
			$mail_headers="";
		   
			$mail_headers = "From:  <".$fromEmailId.">\r\n";
			$mail_headers .= "Reply-To: ".$fromEmailId."\r\n";
			
			if($ccEmailId)
				$mail_headers .= 'Cc: ' .$ccEmailId. "\r\n";
			
			if($ccAdmin)
				$mail_headers .= 'Bcc: ' .$ccEmailId. "\r\n";
			$mail_headers .= "MIME-Version: 1.0\r\n";
			$mail_headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"\r\n\r\n";
			$mail_headers .= "This is a multi-part message in MIME format.\r\n";
			$mail_headers .= "--".$mime_boundary."\r\n";
			$mail_headers .= "Content-type:text/html; charset=iso-8859-1\r\n";
			$mail_headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
			$mail_headers .= $message."\r\n\r\n";
			$mail_headers .= "--".$mime_boundary."\r\n";
			$mail_headers .= "Content-Type: application/octet-stream; name=\"".$fileatt."\"\r\n"; // use different content types here
			$mail_headers .= "Content-Transfer-Encoding: base64\r\n";
			$mail_headers .= "Content-Disposition: attachment; filename=\"".$fileatt."\"\r\n\r\n";
			$mail_headers .= $data."\r\n\r\n";
			$mail_headers .= "--".$mime_boundary."--";
		     
		     
		     
		     $sent = mail( $to, $subject, $email_message, $mail_headers ) ;
		     }
	    
	    
	    } 
		else{
		
	        $mail_headers = "MIME-Version: 1.0\n"; // don't change
		$mail_headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$mail_headers .= "From:".$fromEmailId."\n" ;
		if($ccEmailId)
		         $mail_headers .= 'Cc: ' .$ccEmailId. "\r\n";
		if($ccAdmin)
			 $mail_headers .= 'Bcc: ' .$ccAdmin. "\r\n"; 
		$mail_headers .=  "Reply-To:".$fromEmailId."\n" ;	
		$mail_headers.= "Content-Transfer-Encoding: 8bit;\n\n";
		$mail_headers.= stripslashes($message );
		$mail_headers.= "\n";
                $sent = mail($to, $subject, "", $mail_headers);
					
	    }
		
	    if( !$sent) {
                 if($attachment && !$is_attachment_array) 
	               unlink("$_SESSION[SMAPP_BASE_DIR]/temp/$attachment");
                   return '';
         
           }else{
	   
	   if($attachment && !$is_attachment_array) 
	    unlink("$_SESSION[SMAPP_BASE_DIR]/temp/$attachment");
	    return true;
	   }
	    
      }
      
     /* function sendEmail($to,$subject,$message,$fromEmailId,$attachment=array(),$is_attachment_array=0,$ccEmailId="", $ccAdmin=""){
	 
	 
	
	if(is_string($attachment))
		$attachment=trim($attachment," ");
	
	  if(strlen($attachment) || $is_attachment_array) {
	    
                if($is_attachment_array){
			
		       if($attachment["name"] != "")  
			{  
			$strFilesName = $attachment["name"];  
			$strContent = chunk_split(base64_encode(file_get_contents($attachment["tmp_name"])));  
			
			 if($ccAdmin)
			 $mail_headers .= 'Bcc: ' .$ccEmailId. "\r\n";
			   
			$mail_headers .=    "Mailed-By:<$fromEmailId>" . "\r\n" .
			    'X-Mailer: PHP/' . phpversion()."\r\n";
			
			$mail_headers .= "MIME-Version: 1.0"."\r\n";
			$mail_headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\""."\r\n\r\n";
			
			$email_message = "--".$mime_boundary."\r\n";
		       
			$email_message .= "Content-Type: text/html; charset=iso-8859-1"."\r\n";
			$email_message .= "Content-Transfer-Encoding: 7bit"."\r\n";         
			$email_message .= "$message"."\r\n\r\n";
			
			
			$email_message .= "--".$mime_boundary."\r\n";
			$email_message .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\""."\r\n";
			$email_message .= "Content-Transfer-Encoding: base64"."\r\n";
			$email_message .= "Content-Disposition: attachment; filename=\"".$strFilesName."\""."\r\n\r\n";
			$email_message .= $strContent."\r\n\r\n";
			}
			
			$sent = mail( $to, $subject, $email_message, $mail_headers ) ;
			
		}else if( is_string($attachment)){
	             $fileatt = "$_SESSION[SMAPP_BASE_DIR]/temp/$attachment";
		     $fileatttype = "application/pdf";
		     $fileattname = "$attachment";
		    
		     $file = fopen( $fileatt, 'r+' );
		     $data = fread( $file, filesize( $fileatt ) );
		     fclose( $file );
		    	    
	             //unlink($file);
		     $data = chunk_split(base64_encode($data));
		     $semi_rand = md5(time());
		     $mime_boundary = $semi_rand;
		     
		     $mail_headers="";
		   
			 
		    
		     $mail_headers .= "From:<$fromEmailId>" . " \r\n" .
			   "Reply-To:<$fromEmailId>" . " \r\n" ;
			   
		     if($ccEmailId)
		         $mail_headers .= 'Cc: ' .$ccEmailId. "\r\n";
		     
		     if($ccAdmin)
			 $mail_headers .= 'Bcc: ' .$ccEmailId. "\r\n";
			   
		     $mail_headers .=    "Mailed-By:<$fromEmailId>" . "\r\n" .
			 'X-Mailer: PHP/' . phpversion()."\r\n";
		     
		     $mail_headers .= "MIME-Version: 1.0"."\r\n";
		     $mail_headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\""."\r\n\r\n";
		     
		     $email_message = "--".$mime_boundary."\r\n";
		    
		     $email_message .= "Content-Type: text/html; charset=iso-8859-1"."\r\n";
		     $email_message .= "Content-Transfer-Encoding: 7bit"."\r\n";         
		     $email_message .= "$message"."\r\n\r\n";
		     
		     
		     $email_message .= "--".$mime_boundary."\r\n";
		     $email_message .= "Content-Type: application/octet-stream; name=\"".$fileattname."\""."\r\n";
		     $email_message .= "Content-Transfer-Encoding: base64"."\r\n";
		     $email_message .= "Content-Disposition: attachment; filename=\"".$fileattname."\""."\r\n\r\n";
		     $email_message .= $data."\r\n\r\n";
		     $sent = mail( $to, $subject, $email_message, $mail_headers ) ;
		     }
	    
	    
	    } 
		else{
		
	//	       $mail_headers = "MIME-Version: 1.0\r\n"; // don't change
	//	       $mail_headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	//
	//               $mail_headers .= "From:Admin<".$fromEmailId.">\r\n" ;
	//               $mail_headers .=  "Reply-To:<".$fromEmailId.">\r\n" ;
	//	       if($ccEmailId)
	//	         $mail_headers .= 'Cc: ' .$ccEmailId. "\r\n";
	//		
	//	       $email_message .= $message;
	
	        $mail_headers = "MIME-Version: 1.0\n"; // don't change
		$mail_headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$mail_headers .= "From:".$fromEmailId."\n" ;
		if($ccEmailId)
		         $mail_headers .= 'Cc: ' .$ccEmailId. "\r\n";
		if($ccAdmin)
			 $mail_headers .= 'Bcc: ' .$ccAdmin. "\r\n"; 
		$mail_headers .=  "Reply-To:".$fromEmailId."\n" ;	
		$mail_headers.= "Content-Transfer-Encoding: 8bit;\n\n";
		$mail_headers.= stripslashes($message );
		$mail_headers.= "\n";
                //$to="swarna.r@trizile.com";
		$sent = mail($to, $subject, "", $mail_headers);
					
	    }
		
		//$to="swarna.g@aadyaconsulting.com";
	  
	    if( !$sent) {
                 if($attachment && !$is_attachment_array) 
	               unlink("$_SESSION[SMAPP_BASE_DIR]/temp/$attachment");
                   return '';
         
           }else{
	   
	   if($attachment && !$is_attachment_array) 
	    unlink("$_SESSION[SMAPP_BASE_DIR]/temp/$attachment");
	    return true;
	   }
	    
      }
      */
	function sendEmailForAdminCredentials($fromEmailId, $objSchool,$attachment="", $pwd) {
      
         $toAddress = $objSchool->getAdminEmail();
         $subject = "eVidya - Admin Credentials";

         $msg = $this->createEmailForAdminCredentials( $objSchool, $pwd);
	
         if(!$this->sendEmail($toAddress,$subject,$msg,$fromEmailId,$attachment)) {
           if($cfg_loggingOn) {
              $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$objSchool->getAdminEmail(),logMgr::LG_ERROR);
           }
         }
      }      
      
	      
       
      

      function sendResetPasswordEmail($fromEmailId, $toEmailId,$new_password,$username) {
      
         $toAddress = $toEmailId;

         $subject = "eVidya - new password";

         $msg = $this->createResetPasswordMessageForUser( $fromEmailId, $toEmailId,$new_password,$username);
	
         if(!$this->sendEmail($toAddress,$subject,$msg,$fromEmailId,$attachment)) {
           if($cfg_loggingOn) {
              $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$objUser->getEmail(),logMgr::LG_ERROR);
           }
         }
      }
      

      function sendCommunicationMailBetweenUser($objMessage,$attachment="",$is_attachment_array='') {
	
         if(!$this->sendEmail($objMessage->getToEmail(),$objMessage->getSubject(),$objMessage->getMessage(),$objMessage->getFromEmail(),$attachment,$is_attachment_array)) {
           if($cfg_loggingOn) {
              $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$objUser->getEmail(),logMgr::LG_ERROR);
           }
         }
      }
      
	
       
        function sendRegistrationConfirmationEmailForUser($fromEmailId, $objSchool,$attachment="", $pwd,$school_code) {
      
         $toAddress = $objSchool->getEmail();

         $subject = "Welcome to eVidya - Registration Confirmation";

         $msg = $this->createRegistrationConfirmationMessageForUser( $objSchool, $pwd,$school_code);

	 
	
         if(!$this->sendEmail($toAddress,$subject,$msg,$fromEmailId,$attachment)) {
           if($cfg_loggingOn) {
              $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$objUser->getEmail(),logMgr::LG_ERROR);
           }
         }
	
      }
      
        private function createRegistrationConfirmationMessageForUser( $objUser, $pwd,$school_code) {

	 $_app_images_dir_url  = $_SESSION[SMAPP_BASE_URL]."app/views/images";
	
	 $confirm_id = mt_rand();
	 
	 $query_string = "option=".'confirm_process'."&uid=" . $objUser->getUserId(). "&eid=" .$objUser->getEmail()."&taskname=" .'confirm_process'."&schoolcode=".$school_code;
	 
	 $confirm_url = $_SESSION[SMAPP_BASE_URL]."main.php?".$query_string;
	 //echo $confirm_url;exit;
	 $tempmsg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Templates</title>
			</head>
			
			<body style="text-align: center; background-color:#FFFFFF; font-family: calibri, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; margin:0;">
			<!-- main div start here -->
			<div style="margin-left: auto; margin-right: auto; width: 956px; height: 100%; background-color: #FFFFFF; text-align: left; border:0px solid #B4DD65;">
			    <!-- logo section start here -->
				<div style="width:956px; height:80px;">	
				<img src="'.$_app_images_dir_url.'/logo.gif" width="200px;" height="80px" />
				</div>
				<!-- logo section end here -->
				<div style="width:956px; font-size:1px; height:10px; background-color:#0090FF;"></div>
				
				<!-- center part start here -->
				<div style="width:956px; height:100%;">
				
					<div align="center" style="width:910px; margin:20px; border:0px solid red;">
						<div align="left"  style="font-size:18px; font-weight:bold; color:#0090FF;">eVidya Account </div>
						<div style="border-bottom:1px solid #0090FF;"></div><br />
						<span> Congratulations! <b> '.$objUser->getUserLoginName().' </b>  has been added to the eVidya.Below is your login credentials,please click &nbsp;<a href='.$confirm_url.'><strong>here</strong></a>&nbsp;to complete the registration process.</span>
						<div align="left" style="padding:20px; margin-top:10px; border:1px solid #0090FF;">
						
						<table cellpadding="5" cellspacing="5" style="font-size:12px;" border="0">
							
							<tr>
								<td align="right"><strong>eVidya ID:</strong></td>
								<td align="left">'.$objUser->getEvidyaId().'</td>
							</tr>
							
							<tr>
								<td align="right"><strong>User Name:</strong></td>
								<td align="left">'.$objUser->getUserLoginName().'</td>
							</tr>
							<tr>
								<td align="right"><strong>Password:</strong></td>
								<td align="left">'.$pwd.'</td>
							</tr>
							
						</table>
						
						</div>			
						
					</div>		
					
				
				</div>
				<!-- center part end here -->
			
			
			</div>
			<!-- main div end here -->
			</body>
			</html>';
			
				 return $tempmsg;
			
	}
	
	private function createEmailForAdminCredentials( $objSchool, $pwd ) {

	 $_app_images_dir_url  = $_SESSION[SMAPP_BASE_URL]."app/views/images";
	
	 $tempmsg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Templates</title>
			</head>
			
			<body style="text-align: center; background-color:#FFFFFF; font-family: calibri, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; margin:0;">
			<!-- main div start here -->
			<div style="margin-left: auto; margin-right: auto; width: 956px; height: 100%; background-color: #FFFFFF; text-align: left; border:0px solid #B4DD65;">
			    <!-- logo section start here -->
				<div style="width:956px; height:80px;">	
				<img src="'.$_app_images_dir_url.'/logo.gif" width="200px;" height="80px" />
				</div>
				<!-- logo section end here -->
				<div style="width:956px; font-size:1px; height:5px; background-color:#0090FF;"></div>				
				
				<!-- center part start here -->
				<div style="width:956px; height:100%;">
				
					<div align="center" style="width:910px; margin:20px; border:0px solid red;">
						<div align="left"  style="font-size:18px; font-weight:bold; color:#0090FF;">Thank you for registering to eVidya, your admin credentials as follows</div>
						<div style="border-bottom:1px solid #0090FF;"></div>
						
						<div align="left" style="padding:20px; margin-top:10px; border:1px solid #0090FF;">
						
						<table cellpadding="5" cellspacing="5" style="font-size:12px;" border="0">
							
							
							<tr>
								<td align="right"><strong>Admin Username:</strong></td>
								<td align="left">'.$objSchool->getAdminUserName().'</td>
							</tr>
							
							<tr>
								<td align="right"><strong>Admin Password:</strong></td>
								<td align="left">'.$pwd.'</td>
							</tr>
							
						</table>
						
						</div>			
						
					</div>		
					
				
				</div>
				<!-- center part end here -->
			
			
			</div>
			<!-- main div end here -->
			</body>
			</html>';
			
				 return $tempmsg;
			
	}
	
	
	
	private function createResetPasswordMessageForUser( $fromEmailId, $toEmailId,$new_password,$username) {

	 $_app_images_dir_url  = $_SESSION[SMAPP_BASE_URL]."app/views/images";
	
	 
	 
	 $tempmsg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Templates</title>
			</head>
			
			<body style="text-align: center; background-color:#FFFFFF; font-family: calibri, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; margin:0;">
			<!-- main div start here -->
			<div style="margin-left: auto; margin-right: auto; width: 956px; height: 100%; background-color: #FFFFFF; text-align: left; border:0px solid #B4DD65;">
			    <!-- logo section start here -->
				<div style="width:956px; height:80px;">	
				<img src="'.$_app_images_dir_url.'/logo.gif" width="200px;" height="80px" />
				</div>
				<!-- logo section end here -->
				<div style="width:956px; font-size:1px; height:10px; background-color:#0090FF;"></div>
				
				<!-- center part start here -->
				<div style="width:956px; height:100%;">
				
					<div align="center" style="width:910px; margin:20px; border:0px solid red;">
						<div align="left"  style="font-size:18px; font-weight:bold; color:#0090FF;">eVidya new password </div>
						<div style="border-bottom:1px solid #0090FF;"></div><br />
						
						<div align="left" style="padding:20px; margin-top:10px; border:1px solid #0090FF;">
						
						<table cellpadding="5" cellspacing="5" style="font-size:12px;" border="0">
							
							
							
							<tr>
								<td align="right"><strong>User Name:</strong></td>
								<td align="left">'.$username.'</td>
							</tr>
							<tr>
								<td align="right"><strong>Password:</strong></td>
								<td align="left">'.$new_password.'</td>
							</tr>
							
						</table>
						
						</div>			
						
					</div>		
					
				
				</div>
				<!-- center part end here -->
			
			
			</div>
			<!-- main div end here -->
			</body>
			</html>';
			
				 return $tempmsg;
			
	}
	
	
	function sendEvidyaIdCard($arrEmailId,$admin_emailid){
		
		foreach($arrEmailId as $array_emailid){
		
			$toAddress = $array_emailid['email_id'];
			$subject = "eVidya - Account details for ".$array_emailid['Name'];
	       
			$msg = $this->createEmailMessageforEvidyaIdCard( $array_emailid);
		       
			if(!$this->sendEmail($toAddress,$subject,$msg,$admin_emailid,$attachment)) {
			  if($cfg_loggingOn) {
			     $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$admin_emailid,logMgr::LG_ERROR);
			  }
			}
		}
	}
	
	function createEmailMessageforEvidyaIdCard( $array_emailid){
		
		
	 $_app_images_dir_url  = $_SESSION[SMAPP_BASE_URL]."app/views/images";
	
	 
	 
	 $tempmsg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Templates</title>
			</head>
			
			<body style="text-align: center; background-color:#FFFFFF; font-family: calibri, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; margin:0;">
			<!-- main div start here -->
			<div style="margin-left: auto; margin-right: auto; width: 956px; height: 100%; background-color: #FFFFFF; text-align: left; border:0px solid #B4DD65;">
			    <!-- logo section start here -->
				<div style="width:956px; height:80px;">	
				<img src="'.$_app_images_dir_url.'/logo.gif" width="200px;" height="80px" />
				</div>
				<!-- logo section end here -->
				<div style="width:956px; font-size:1px; height:10px; background-color:#0090FF;"></div>
				
				<!-- center part start here -->
				<div style="width:956px; height:100%;">
				
					<div align="center" style="width:910px; margin:20px; border:0px solid red;">
						<div align="left"  style="font-size:12px; font-weight:bold; color:#0090FF;">Please find the account details of your account below</div>
						<div style="border-bottom:1px solid #0090FF;"></div><br />
						
						<div align="left" style="padding:20px; margin-top:10px; border:1px solid #0090FF;">
						
						<table cellpadding="5" cellspacing="5" style="font-size:12px;" border="0">
							
							
							<tr>
								<td align="right"><strong>Name:</strong></td>
								<td align="left">'.$array_emailid['Name'].'</td>
							</tr>
							<tr>
								<td align="right"><strong>URL:</strong></td>
								<td align="left">'.$array_emailid['URL'].'</td>
							</tr>
							<tr>
								<td align="right"><strong>Class/Division:</strong></td>
								<td align="left">'.$array_emailid['Class_division'].'</td>
							</tr>
							<tr>
								<td align="right"><strong>eVidya ID:</strong></td>
								<td align="left">'.$array_emailid['eVidya_ID'].'</td>
							</tr>
							<tr>
								<td align="right"><strong>Username:</strong></td>
								<td align="left">'.$array_emailid['Username'].'</td>
							</tr>
							
							
						</table>
						
						</div>			
						
					</div>		
					
				
				</div>
				<!-- center part end here -->
			
			
			</div>
			<!-- main div end here -->
			</body>
			</html>';
			
	return $tempmsg;	
		
		
	}
	
	function sendExamScheduleForStudentAndParents($arrParentEmail,$args,$admin_emailid){
		
		//foreach($arrEmailId as $array_emailid){
		
			$toAddress = implode(", ",$arrParentEmail);
			$subject = "eVidya - Exam Schedule of ".$args['Name']. " for ".$args['exam_name'];
	       //echo $admin_emailid;
			$msg = $this->createEmailMessageforExamSchedule( $args);
		       
			if(!$this->sendEmail($toAddress,$subject,$msg,$admin_emailid,$attachment)) {
			  if($cfg_loggingOn) {
			     $this->logmgr->writeToLog('communication_helper', "Failed to send email to EmailId:".$admin_emailid,logMgr::LG_ERROR);
			  }
			}
		//}
	}
	
	function createEmailMessageforExamSchedule( $args){
		
		
	 $_app_images_dir_url  = $_SESSION[SMAPP_BASE_URL]."app/views/images";
	
	 
	 
	 $tempmsg='<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<title>Templates</title>
			</head>
			
			<body style="text-align: center; background-color:#FFFFFF; font-family: calibri, Tahoma, Arial, Helvetica, sans-serif; font-size: 12px; margin:0;">
			<!-- main div start here -->
			<div style="margin-left: auto; margin-right: auto; width: 956px; height: 100%; background-color: #FFFFFF; text-align: left; border:0px solid #B4DD65;">
			    <!-- logo section start here -->
				<div style="width:956px; height:80px;">	
				<img src="'.$_app_images_dir_url.'/logo.gif" width="200px;" height="80px" />
				</div>
				<!-- logo section end here -->
				<div style="width:956px; font-size:1px; height:10px; background-color:#0090FF;"></div>
				
				<!-- center part start here -->
				<div style="width:956px; height:100%;">
				
					<div align="center" style="width:910px; margin:20px; border:0px solid red;">
						<div align="left"  style="font-size:12px; font-weight:bold; color:#0090FF;">Please find the '.$args['exam_name'].' schedule  below</div>
						<div style="border-bottom:1px solid #0090FF;"></div><br />
						
						<div align="left" style="padding:20px; margin-top:10px; border:1px solid #0090FF;">
						
						<table cellpadding="5" cellspacing="5" style="font-size:12px;" border="0">
							
							
							<tr>
								<th>'.$app_strings['FIELD_DATE_LBL'].'</th>
								<th>'.$app_strings['FIELD_SUBJECTNAME_LBL'].'</th>
			 
							 </tr>';
							 
							 
							 
			$count=0;
                          foreach($args['schedules'] as $objExam) {   
			    
                            
                        $tempmsg.=' <tr class="row1">
                           <td>'.$objExam->getExamDate().'</td>
                           <td>'.$objExam->getSubjectName().'</td></tr>';
			  }
							
							
			 $tempmsg.='			</table>
						
						</div>			
						
					</div>		
					
				
				</div>
				<!-- center part end here -->
			
			
			</div>
			<!-- main div end here -->
			</body>
			</html>';
	//echo $tempmsg;exit;		
	return $tempmsg;	
		
		
	}
	
	
      }   // end of class
?>
