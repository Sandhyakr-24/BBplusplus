<?php

/**
* This file is to be included in all the PHP files. This file checks all initial sanity checks and include
* the basic include files.
*/


   if(!isset($_SESSION['ABSAPP_CONFIG_FILE'])) {
		echo "checkandincludes: Unauthorised Access.";  // the request didnt come through service call
		exit();
	}

   require_once($_SESSION['ABSAPP_CONFIG_FILE']);  //config file
   require_once($_SESSION['ABSAPP_DB_CONFIG_FILE']); // dbconfig file
	
   // autoload function in auto_classloader.php for automatically loading the required Class files
   // for the Objects, whenever  they are used.
   // This avoids the need to call require or include for all classes used in each of the php files
	
   require_once("auto_classloader.php");
   
?>