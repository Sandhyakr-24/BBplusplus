<?php
session_start();
/**
* This file is to be included in all the PHP files (is added to checksandincludes.php)
*/



	// automatically loads the required Class files for the Objects, whenever
	// they are used. All the directories in the include path will be searched.
	// this avoids the need to call require or include for all classes used in each of the php files
	
   function __autoload($classname) {
	
      global $cfg_autoload_includepath_rootdirectory;

      $includepath = get_include_path();
   
      if(stristr($includepath,$cfg_autoload_includepath_rootdirectory) === FALSE) {  // if include path is not already set
      
              $emrppath =  $_SESSION['EMRP_BASE_DIR']."/objects". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/app/classes". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/reg". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/reg/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/auth". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/auth/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmhome". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmhome/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/profile". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/profile/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/communication". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/communication/smshandler". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmreports". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmreports/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmcharts". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/prmcharts/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmhome". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmhome/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmreports". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmreports/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmcharts". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/modules/chmcharts/views". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/objects". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/dbhandler". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/logging". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/errorhandler". PATH_SEPARATOR
                            . $_SESSION['EMRP_BASE_DIR']."/utils". PATH_SEPARATOR

                            . $includepath;

              set_include_path($emrppath);
      
      }
      
      require_once($classname.".php"); // include the php file for the class (from any of the directories in the include path)
                                       // NOTE: The Class name and the PHP file in which the class is defined should be identical.
	}
?>
