<?php

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
      
           $abspath =  $_SESSION['ABSAPP_BASE_DIR']."/objects". PATH_SEPARATOR
                	    . $_SESSION['ABSAPP_BASE_DIR']."/servicefunctions". PATH_SEPARATOR
                	    . $_SESSION['ABSAPP_BASE_DIR']."/app/classes". PATH_SEPARATOR
                            . $_SESSION['ABSAPP_BASE_DIR']."/logging". PATH_SEPARATOR
                            . $_SESSION['ABSAPP_BASE_DIR']."/errorhandler". PATH_SEPARATOR
                            . $_SESSION['ABSAPP_BASE_DIR']."/utils". PATH_SEPARATOR
	   		    
			    . $includepath;
              set_include_path($abspath);
      
      }
    
      require_once($classname.".php"); // include the php file for the class (from any of the directories in the include path)
                                       // NOTE: The Class name and the PHP file in which the class is defined should be identical.
	}
?>
