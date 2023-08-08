<?php
    session_start();
    
    require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

    class app_dao {

      private $dbh; // dbhandler object

      function __construct() {
	  
         $this->dbh =  emrp_dbhandler::getInstance();
      }
      
      function executeConstructedQuery($constrQuery){
          
         return $arrResult = $this->dbh->readRecordsWithQuery($constrQuery);
      }
      
    }
	// end of the Class app_dao
?>