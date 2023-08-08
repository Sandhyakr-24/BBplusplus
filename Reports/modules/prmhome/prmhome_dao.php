<?php

  session_start();

  require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

  class prmhome_dao {
        
       
	private $dbh;
        
    function __construct() {
            
	    $this->dbh = emrp_dbhandler::getInstance();
    }
	
	
    function getDashboardCharts(){
        
        $query="select * from charts_prm_tbl where is_dashboard = 1 order by display_order asc";
        
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        return $arrResult;
    }
	
	function getAllCharts(){
	    
	    $query="select * from charts_prm_tbl order by display_order asc";
	    
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	    return $arrResult;
	}
 }
?>