<?php
	session_start();
	
	$Module = 'chmcharts';   // this is the module directory name.

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		echo "Invalid Session. Please login.";
		exit();
	}
	require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");


    // if the user_id is not set (means user is not authenticated), direct to the login page
    if(!isset($_SESSION['a3portal_userid'])) {
        header("Location: ".$_SESSION['EMRP_BASE_DIR'].$cfg_logincontroller);
        exit();
    }

    $taskname = $_REQUEST['taskname'];

    $app_helper = new app_helper();
    
    /* remove this after DB is setup
    $arrUserName = $app_helper->getUserFullNameByUserId($_SESSION['a3portal_userid']);
    $args['user_name'] = $arrUserName[0]['firstname']." ".$arrUserName[0]['lastname'];
    $_SESSION['user_name'] = $args['user_name'];
    */


    $charts_helper = new chmcharts_helper();
    $charts = array();
    $charts = $charts_helper->getAllCharts();
    
    $arrChartsData = array();
    
    foreach($charts as $chart) {
 
        $chartdata = $charts_helper->getChartData($chart['view_name'], $chart['orderby_columnname'],$chart['maxrecordstodisplay'], $chart['maxrecordsfrom']);
        array_push($arrChartsData, $chartdata);
    }
    
    switch($taskname) {
	
        default:
        case 'show_chartshome':
       
		  $arrErrMsg = array();
		  $args['charts'] = $charts;
		  $args['chartsdata'] = $arrChartsData;
		  $args['view_name'] = 'chmcharts_view_home';    
		  $app_helper->showView($args, $Module, $arrErrMsg);
          break;
	}
?>
