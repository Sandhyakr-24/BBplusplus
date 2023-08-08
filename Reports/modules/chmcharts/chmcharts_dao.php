<?php

  session_start();

  require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

  class chmcharts_dao {
        
       
	private $dbh;
        
    function __construct() {
            
	    $this->dbh = emrp_dbhandler::getInstance();
    }
	
	
    function getDashboardCharts(){
        
        $query="select * from charts_chm_tbl where is_dashboard = 1 order by display_order asc";
        
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        return $arrResult;
    }
	
	function getAllCharts(){
	    
	    $query="select * from charts_chm_tbl order by display_order asc";
	    
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	    return $arrResult;
	}
	

	function getChartData($chartview, $orderbycolumnname, $maxrecordstoshow, $maxrecordsfrom) {

	    // To fetch the last $maxrecordstoshow number of entries. 
	    // If to start from bottom, First select $maxrecordstoshow entries from last by ordering 'id' in DSC and then order the result set in ASC so that the final result will be in the ASC order
	    if($maxrecordsfrom == 'bottom')
	       $query="select * from (select * from ".$chartview." order by ".$orderbycolumnname." DESC limit ".$maxrecordstoshow.") sub order by ".$orderbycolumnname." ASC";
	    else // select 'maxrecordstoshow' starting from top
	        $query="select * from ".$chartview." order by '".$orderbycolumnname."' ASC limit ".$maxrecordstoshow;
     
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	    return $arrResult;
	}
 }
?>