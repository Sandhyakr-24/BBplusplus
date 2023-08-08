<?php

    session_start();

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		
        echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
	 
    require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");
    
    class chmreports_helper {

        
        private $logmgr;
        private $app_reports_dao;
        private $reports_dao;
	

        function __construct() {
            
            $this->logmgr  = logMgr::getInstance();
            $this->reports_dao = new chmreports_dao();
	        $this->app_reports_dao = new app_reports_dao();
        }
	
	    function getMyReports($user_id) {
	        
	        return $this->reports_dao->getMyReports($user_id);
	    }
	
	    function getAllReports(){
	        
	        return $this->reports_dao->getAllReports();
	    }
	
	
	    function getAllColumnsByReportId($report_id){
	        
	        return $this->reports_dao->getAllColumnsByReportId($report_id);
	    }
	
	    function getAllwhereclauseByReportId($report_id){
	        
	        return $this->reports_dao->getAllwhereclauseByReportId($report_id);
	    }
	
	    function getReportByReportId($report_id){
	        
	        return $this->reports_dao->getReportByReportId($report_id);
	    }
	

	    function addMyreport($objReport){
	        
	        $this->app_reports_dao->insertMyReports($objReport);	    
	    }
	
	    function getMyReportIdWithRepObj($objReport){
	        
	        return $this->reports_dao->getMyReportIdWithRepObj($objReport);
	    }
	
	    function addMyColumn($objReport){
	        
	        $this->app_reports_dao->insertMyColumn($objReport);
	    }
	
	    function addMyWhere($objReport){
	        
	        $this->app_reports_dao->insertMyWhere($objReport);
	    }
	
	    function getMyColumnsByReportId($myreport_id){
	        
	        return $this->reports_dao->getMyColumnsByReportId($myreport_id);
	    }
	
	    function getMywhereclauseByReportId($myreport_id){
	        
	        return $this->reports_dao->getMywhereclauseByReportId($myreport_id);
	    }
	
	    function getMyReportByMyReportId($myreport_id){
	        
	        return $this->reports_dao->getMyReportByMyReportId($myreport_id);
	    }
	
	    function deleteMyReportByReportId($myreport_id){
	        
	        $this->app_reports_dao->deleteMyReportByMyReportId($myreport_id);
	        $this->app_reports_dao->deleteMyColumnsByMyReportId($myreport_id);
	        $this->app_reports_dao->deleteMyWhereByMyReportId($myreport_id);
	    }
	
	    function getAllMasterRecords(){
	        
	        return $this->reports_dao->getAllMasterRecords();
	    }
	    
    }
?>