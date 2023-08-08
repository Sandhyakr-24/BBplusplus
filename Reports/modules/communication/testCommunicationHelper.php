<?php
	session_start();
	
/**
* To test the communication_helper class functions
*
*/

    if(!isset($_SESSION[APP_BASE_DIR])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
    require_once($_SESSION[APP_BASE_DIR]."/app/boot/checksandincludes.php");
    require_once($_SESSION[APP_BASE_DIR]."/app/views/includes/include_directory_paths.php");

    $comnhelper = new communication_helper();

    $fromEmailId = "admin@esportsclub.net";
    $toAddress = "swarna.g@aadyaconsulting.com";
    $clubName = "Club Name";
    $userName = "UserFirstName UserLastName";
    $playerName = "PlayerFirstName PlayerLastName";
    
    
   // $comnhelper->sendUserInstallmentPaymentFailureEmail($fromEmailId, $toAddress, $clubName, $userName, $playerName);
     $comnhelper->sendAdminCreditCardUpdateAlertEmail($toAddress,  $userName);

?>
