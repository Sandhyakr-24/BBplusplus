<?php

    session_start();

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		
        echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
	 
    require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");
    
    class chmcharts_helper {

        
        private $logmgr;
        private $charts_dao;
	

        function __construct() {
            
            $this->logmgr  = logMgr::getInstance();
            $this->charts_dao = new chmcharts_dao();
        }
	
	
	    function getAllCharts(){
	        
	        return $this->charts_dao->getAllCharts();
	    }
	    
	    function getDashboardCharts(){
	        
	        return $this->charts_dao->getDashboardCharts();
	    }
	    
	    function getChartData($chartview, $orderbycolumnname, $maxrecordstodisplay, $maxrecordsfrom) {
	        
	        return $this->charts_dao->getChartData($chartview, $orderbycolumnname, $maxrecordstodisplay, $maxrecordsfrom);
	    }
	}
?>