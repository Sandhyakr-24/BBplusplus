<?php
session_start();

    $Module ='prmreports';

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
	     
        echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	}
	 
	require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");
    
    $taskname = $_REQUEST['taskname'];
     
    if($_REQUEST['menu_top_activeitem']){
        $_SESSION['menu_top_activeitem'] = $_REQUEST['menu_top_activeitem'];
        $args['menu_top_activeitem'] = $_REQUEST['menu_top_activeitem'];
    }
    else if($_SESSION['menu_top_activeitem'])
        $args['menu_top_activeitem'] = $_SESSION['menu_top_activeitem'];
    else {
        $_SESSION['menu_top_activeitem']= "Dashboard";
        $args['menu_top_activeitem'] = $_SESSION['menu_top_activeitem'];
    }
    
    $app_helper = new app_helper();
    $reports_helper = new prmreports_helper();
    
  
    switch($taskname) {
        
        default: 

        case 'show_reports_reportshome': 

            $args['view_name'] = "prmshow_reports_view_reportshome";
            $args['arrAllReports'] = $reports_helper->getAllReports();
            //print_r($args['arrAllReports']);
            $errmsg = array();
            $app_helper->showView($args,$Module,$errmsg);
            
            break;
 
        case 'show_report_view_datatable_default':
            
            //$em = new exceptionMgr(" ");
            //$em->logInfo("reports_controller: taskname: ".$taskname);
            
        
            $reportid = $_REQUEST['report_id'];
            $report = $reports_helper->getReportByReportId($_REQUEST['report_id']);
            $arrAllColumns = $reports_helper->getAllColumnsByReportId($reportid);
            
            $strColumnsToFetch = "";
            $selectedcolumns = array();
            $selectedcolumns_labels = array();
            
            foreach($arrAllColumns  as $column) {
                    $strColumnsToFetch .= $column['report_column_name'].",";
                    array_push($selectedcolumns,$column['report_column_name']);
                    array_push($selectedcolumns_labels, $column['report_column_label']);
            }

            /* Data is being read by ajax from the show_report_view_datatable directly. No need to load all the data 
            
            // Construct the query
            
            $constrQuery= "";
            
            if($strColumnsToFetch != "") {
                $constrQuery="select ".substr($strColumnsToFetch,0,-1)." from ".$report[0]['view_name']; // remove last comma
                
                $execResult = $app_helper->executeConstructedQuery($constrQuery);
            }
            */

            
            $args['view_name'] = "prmshow_report_view_datatable";
            // $args['arrResult'] = $execResult;
            $args['selectedcolumns'] = $selectedcolumns_labels;
            $args['report_name'] = $report[0]['report_name'];
            
            // These SESSION values will be used by ajaxssp_getdatatablerecords
            $_SESSION['emrp_selectedcolumns'] = $selectedcolumns;
            $_SESSION['emrp_db_report_view_name'] = $report[0]['view_name'];
            $_SESSION['emrp_uniquevaluecolumnname'] = $report[0]['uniquevaluecolumnname'];
            $_SESSION['emrp_wherequery'] = $whereClause;
            
            $errmsg = array();
            $app_helper->showView($args,$Module,$errmsg);
            
            break;
            
            
        case 'show_report_view_datatable_custom':
            
            $reportid = $_REQUEST['report_id'];

            $report = $reports_helper->getReportByReportId($_REQUEST['report_id']);
            
            $arrAllColumns = $reports_helper->getAllColumnsByReportId($reportid);
            
            $arrAllwhereclause = $reports_helper->getAllwhereclauseByReportId($reportid);

            $strColumnsToFetch = "";
            $selectedcolumns = array();
            $selectedcolumns_labels = array();
            
            foreach($arrAllColumns  as $column) {
                $checkboxname = "col_".$column['report_column_name'];
                if($_REQUEST[$checkboxname] == $column['report_column_name']) {
                      $strColumnsToFetch = $strColumnsToFetch.$column['report_column_name'].",";
                      array_push($selectedcolumns,$column['report_column_name']);
                      array_push($selectedcolumns_labels, $column['report_column_label']);
                  }
            }
            
            $strWhereclause =  "";
            foreach($arrAllwhereclause as $wherecolumn) {
                
                $wherecolname = $wherecolumn['report_whereclause_column_name'];
   
                if($wherecolumn['wc_datatype'] == 'datetime') {
                    
                    $fromdatefield = 'fromdate_'.$wherecolname;
                    $todatefield = 'todate_'.$wherecolname;
                    $fromdatevalue = "";
                    $todatevalue = "";
                    
                    if($_REQUEST[$fromdatefield] != "") {
                        $fromdatevalue_anyformat = $_REQUEST[$fromdatefield];
                        $fromtimestampval = strtotime($fromdatevalue_anyformat);
                        $fromdatevalue = date("Y-m-d",$fromtimestampval); // in YYYY-MM-DD format
                    }
                    if($_REQUEST[$todatefield] != "") {
                        $todatevalue_anyformat = $_REQUEST[$todatefield];
                        $totimestampval = strtotime($todatevalue_anyformat);
                        $todatevalue = date("Y-m-d",$totimestampval); // in YYYY-MM-DD format
                    }
                    
                    if(($fromdatevalue != "") && ($todatevalue != "")) {
                        $datequerystr = " DATE(".$wherecolname.") BETWEEN '".$fromdatevalue."' AND '".$todatevalue."'";
                    }
                    else if($fromdatevalue != "") {
                        $datequerystr = " DATE(".$wherecolname.") >= '".$fromdatevalue."'";
                    }
                    else if($todatevalue != "") {
                        $datequerystr = " DATE(".$wherecolname.") <= '".$todatevalue."'";
                    }
                    else {
                        $datequerystr = "";
                    }

                    if($datequerystr != "")
                        $strWhereclause .= $datequerystr." AND";
                    
                }
                else if($wherecolumn['wc_datatype'] == 'varchar') {
                    if(($_REQUEST[$wherecolname] != "") && ($_REQUEST[$wherecolname] != 'select')) {
                        $strWhereclause .= " ".$wherecolname." LIKE '%".$_REQUEST[$wherecolname]."%' AND";
                     }
                }
                else if($wherecolumn['wc_datatype'] == 'integer') {
                    
                    $fromintvaluefield = 'fromvalue_'.$wherecolname;
                    $tointvaluefield = 'tovalue_'.$wherecolname;
                    $fromintvalue = "";
                    $tointvalue = "";
                    
                    if($_REQUEST[$fromintvaluefield] != "") {
                        $fromintvalue = $_REQUEST[$fromintvaluefield];
                    }
                    if($_REQUEST[$tointvaluefield] != "") {
                        $tointvalue = $_REQUEST[$tointvaluefield];
                    }
                    
                    if(($fromintvalue != "") && ($tointvalue != "")) {
                        $intvaluequerystr = " ".$wherecolname." BETWEEN ".$fromintvalue." AND ".$tointvalue." ";
                    }
                    else if($fromintvalue != "") {
                        $intvaluequerystr = " ".$wherecolname." >= ".$fromintvalue." ";
                    }
                    else if($tointvalue != "") {
                        $intvaluequerystr = " ".$wherecolname." <= ".$tointvalue." ";;
                    }
                    else {
                        $intvaluequerystr = "";
                    }
                    
                    if($intvaluequerystr != "")
                        $strWhereclause .= $intvaluequerystr." AND";
                        
                }
                
                
                else if(($_REQUEST[$wherecolname] != "") && ($_REQUEST[$wherecolname] != 'select')) {
                        $strWhereclause .= " ".$wherecolname." = '".$_REQUEST[$wherecolname]."' AND";
                }
                else;
               
            }
  
            /* Data is being read by ajax from the show_report_view_datatable directly. No need to load all the data
             
            // Construct the query
            
            $constrQuery= "";
             
            if($strColumnsToFetch != "") {
                $constrQuery="select ".substr($strColumnsToFetch,0,-1)." from ".$report[0]['view_name']; // remove last comma
                if($strWhereclause != ""){
                    $constrQuery.=" where ".substr($strWhereclause,0,-3); // Remove last 'AND'
                }
                $execResult = $app_helper->executeConstructedQuery($constrQuery);
            }
            */
            
            $args['view_name'] = "prmshow_report_view_datatable";
            // $args['arrResult'] = $execResult;
            $args['selectedcolumns'] = $selectedcolumns_labels;
            $args['report_name'] = $report[0]['report_name'];
            
            // These SESSION values will be used by ajaxssp_getdatatablerecords
            $_SESSION['emrp_selectedcolumns'] = $selectedcolumns;
            $_SESSION['emrp_db_report_view_name'] = $report[0]['view_name'];
            $_SESSION['emrp_uniquevaluecolumnname'] = $report[0]['uniquevaluecolumnname'];
            
            if($strWhereclause != ""){
                $whereQuery .= substr($strWhereclause,0,-3); // Remove last 'AND'
            }
            else 
                $whereQuery = "";
            
            $_SESSION['emrp_wherequery'] = $whereQuery;

            $errmsg = array();
            $app_helper->showView($args,$Module,$errmsg);

            break;
 
    }    
?>