<?php
   
  class app_reports_dao {
        
      private $dbh; // dbhandler object

      function __construct() {
	  
           $this->dbh = emrp_dbhandler::getInstance();
      }
      
      function insertMyReports($objReports) {
        
         $data = array(
	
	    'myreport_id' => $objReports->getMyReportId(),
	    'report_id' => $objReports->getReportId(),
	    'user_id' => $objReports->getUserId(),
	    'report_name' => $objReports->getReportName(),
	    'view_name' => $objReports->getViewName(),
	    'report_description' => $objReports->getReportDesc(),
	    'unique_id' => $objReports->getUniqueId(),
	    'view_type' =>$objReports->getViewType()
         );
        
         $this->dbh->insertRecords('myreports_tbl',$data);
      }
      
      function insertMyColumn($objReports) {
        
         $data = array(
	
	    'myreport_column_id' => $objReports->getMyReportColumnId(),
	    'report_column_id' => $objReports->getReportColumnId(),
	    'myreport_id' => $objReports->getMyReportId(),
	    'column_sequence_id' => $objReports->getMyColumnSeqId(),
	    'orderby_sequence_id' => $objReports->getOrderbySeqId()
         );
        
         $this->dbh->insertRecords('myreport_columns_tbl',$data);
      }
      
      function insertMyWhere($objReports) {
        
         $data = array(
	
	       'myreport_id' => $objReports->getMyReportId(),	    
	       'report_whereclause_seqid' =>$objReports->getReportWCSeqId(),
	       'report_whereclause_column_name' =>$objReports->getWCColumnName(),
	       'report_whereclause_column_label' => $objReports->getWCColumnLabel(),
	       'report_operator' => $objReports->getReportOperator(),
	       'report_whereclause_value1' => $objReports->getReportWCValue1(),
	       'report_whereclause_value2' => $objReports->getReportWCValue2()
            );
        
           $this->dbh->insertRecords('myreport_whereclause_tbl',$data);
      }
      
      
      function deleteMyReportByMyReportId($myreport_id){
	  
	       $condition= " myreport_id='".$myreport_id."' ";
	  
	       $this->dbh->deleteRecords('myreports_tbl',$condition);
      }
     
      function deleteMyColumnsByMyReportId($myreport_id){
          
	       $condition= " myreport_id='".$myreport_id."' ";
	  
	       $this->dbh->deleteRecords('myreport_columns_tbl',$condition);
	  
      }
      
      function deleteMyWhereByMyReportId($myreport_id){
          
	       $condition= " myreport_id='".$myreport_id."' ";
	  
	       $this->dbh->deleteRecords('myreport_whereclause_tbl',$condition);
      }
 
  }
?>