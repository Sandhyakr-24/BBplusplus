<?php

  session_start();

  require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

  class chmreports_dao {
        
       
	private $dbh;
        
    function __construct() {
            
	    $this->dbh = emrp_dbhandler::getInstance();
    }
	
	
	function getMyReports($user_id) {
	    
	   $condition = " user_id='".$user_id."' order by myreport_id desc";
	   
	   $arrResult = $this->dbh->readRecordsAllFields('myreports_chm_tbl',$condition);
	   
	   return $arrResult;
	}
	
	function getAllReports(){
	    
	    $query="select rt.*,rgt.group_name from reports_chm_tbl rt left join reports_chm_groups_tbl rgt
	                  on rt.group_id=rgt.report_group_id  where is_active=1 order by rgt.display_order asc, rt.display_order asc";
	    
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	    return $arrResult;
	}
	

	function getAllColumnsByReportId($report_id){
	    
	    $condition= " report_id='".$report_id."' order by report_column_seqid";
	    
	    $arrResult = $this->dbh->readRecordsAllFields('report_chm_columns_tbl',$condition);
	   
	    return $arrResult;
	}
	
	function getAllwhereclauseByReportId($report_id){
	    
	    $condition= " report_id='".$report_id."' order by report_whereclause_seqid";
	    
	    $arrResult = $this->dbh->readRecordsAllFields('report_chm_whereclause_tbl',$condition);
	   
	    return $arrResult;
	}
	
	function getReportByReportId($report_id){
	    
	    $condition= " report_id='".$report_id."'";
	    
	    $arrResult = $this->dbh->readRecordsAllFields('reports_chm_tbl',$condition);
	   
	    return $arrResult;
	}
	

	function getMyReportIdWithRepObj($objReport){
	    
	     $condition= " report_id='".$objReport->getReportId()."' AND
	                   report_name='".$objReport->getReportName()."' AND
			   
			   unique_id='".$objReport->getUniqueId()."' AND
			   
			   user_id='".$objReport->getUserId()."'     
	     
	                   ";
	    
	    $arrResult = $this->dbh->readRecordsAllFields('myreports_chm_tbl',$condition);
	    return $arrResult[0]['myreport_id'];
	}
	
	
	function getMyColumnsByReportId($myreport_id){
	    
	      $query ="select rct.report_column_auto_id,
			    rct.report_id,
			    rct.report_column_seqid,
			    rct.report_column_name,
			    rct.report_column_label,
			    rct.column_datatype,
			    mct.column_sequence_id,
			    mct.orderby_sequence_id
			    
			    from report_chm_columns_tbl as rct,
			         myreport_chm_columns_tbl as mct,
				 myreports_chm_tbl as mt
				where
				 mt.report_id=rct.report_id AND
				 mt.myreport_id=mct.myreport_id AND
				 rct.report_column_auto_id=mct.report_column_id AND
				 mct.myreport_id='".$myreport_id."' AND
				 mt.myreport_id='".$myreport_id."'
				 
				 group by mct.report_column_id order by mct.column_sequence_id
	    
	    
	    ";
	    
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	   
	   return $arrResult;
	}
	
	function getMywhereclauseByReportId($myreport_id){
	    
	    $query =" select myreport_whereclause_id,
			    rwt.myreport_id,
			    report_whereclause_seqid,
			    report_whereclause_column_name,
			    report_whereclause_column_label,
			    report_operator,
			    report_whereclause_value1,
			    report_whereclause_value2
			    
			    from myreport_chm_whereclause_tbl as rwt
				where
				 rwt.myreport_id='".$myreport_id."'
				 
				 order by report_whereclause_seqid
		    ";
	    
	    
	    $arrResult = $this->dbh->readRecordsWithQuery($query);
	   
	   return $arrResult;
	}
	
	function getMyReportByMyReportId($myreport_id){
	    
	    $condition= " myreport_id='".$myreport_id."'";
	    
	    $arrResult = $this->dbh->readRecordsAllFields('myreports_chm_tbl',$condition);
	   
	   return $arrResult;
	}
	
	
	function getAllMasterRecords(){
	    
	    $arrResult = $this->dbh->readRecordsAllFields('report_chm_master_wc_tbl');
	   
	   return $arrResult;
	}
	
 }
?>