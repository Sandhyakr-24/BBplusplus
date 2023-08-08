<?php

    session_start();

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		
        echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
	 
    require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");
    
    class prmhome_helper {

        
        private $logmgr;
        private $home_dao;
	

        function __construct() {
            
            $this->logmgr  = logMgr::getInstance();
            $this->home_dao = new prmhome_dao();
        }
    }
?>