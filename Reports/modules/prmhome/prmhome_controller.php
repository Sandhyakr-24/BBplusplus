<?php
	session_start();
	
	$Module = 'prmhome';   // this is the module directory name.

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

    $home_helper = new prmhome_helper();

    $charts_helper = new prmcharts_helper();

    $charts = $charts_helper->getDashboardCharts();

    $arrChartsData = array();

    foreach($charts as $chart) {
        
        $chartdata = $charts_helper->getChartData($chart['view_name'], $chart['orderby_columnname'],$chart['maxrecordstodisplay'], $chart['maxrecordsfrom']);
        array_push($arrChartsData, $chartdata);
    }

    switch($taskname) {
	
        default:
        case 'show_homepage':
            
		  $arrErrMsg = array();
		  $args['charts'] = $charts;
		  $args['chartsdata'] = $arrChartsData;
		  $args['view_name'] = 'prmhome_view_dashboard';    
		  $app_helper->showView($args, $Module, $arrErrMsg);
          break;
	}
?>
