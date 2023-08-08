<?php
session_start();


    if(!isset($_SESSION['EMRP_BASE_DIR'])) {
		echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
	 }
	 
	 require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");


     class app_helper {
    
      private $logmgr;
      private $app_dao;
      

      function __construct() {
      
         $this->logmgr  = logMgr::getInstance();
         $this->app_dao = new app_dao();
    
      }

      function showView($args, $module, $errmsg='') {
          
         $viewname = $args['view_name'];
         $viewfilepath =  $_SESSION['EMRP_BASE_DIR']."/modules/".$module."/views/".$viewname.".php";

         try {
            if(!file_exists($viewfilepath)) {
                 throw new exceptionMgr("View file does not exist. File: ".$viewfilepath);
            }
         }
		 catch(exceptionMgr $e){
		    $e->handleError();
		 }

         try {
             //require_once($viewfilepath); // this is causing error (objView not an object error) at time. The reason seems to be that the file is not fully loaded and objView is not yet created.
             $objView = new  $viewname; // To fix it, dynamically create the objView object from the classname (object of the class 'viewname') instead of including objView in the view file itself.
                                        //
             if(!is_object($objView)) {
                throw new exceptionMgr("Failed to create the object 'objView' to run show() function. viewfile: ".$viewfilepath);
             }
             $objView->show($args, $errmsg);
         }
		 catch(exceptionMgr $e){
		     $e->handleError();
		 }
      }
      
      function executeConstructedQuery($constrQuery){
          
          return $this->app_dao->executeConstructedQuery($constrQuery);
      }
    
}
?>