<?php

session_start();


    $Module ='auth';

    if(!isset($_SESSION['EMRP_BASE_DIR'])) {

        echo $app_strings['ERRMSG_INVALIDSESSION'];
		exit();
    }

	require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

    $taskname = $_REQUEST['taskname'];

    $app_helper = new app_helper();
    $auth_helper = new auth_helper();
    
    
    switch($taskname) {
        
      case 'show_login':  // Show the login page
	       $errmsg = array();	
           $args['view_name'] = "auth_view_login";	     
	       $app_helper->showView($args,$Module,$errmsg);	     
	       break;
         
      case 'confirm_process':

	       $errmsg = array();	
	       $confirm_user = $auth_helper->confirmUser($_REQUEST['uid'],$_REQUEST['eid']);
	
	       if($confirm_user){
		      $auth_helper->activateUser($_REQUEST['uid']);
	       }
	
	       $args['view_name'] = "auth_view_login";
	       $app_helper->showView($args, $Module, $errmsg); // authentication failed
	       break;

	  
      case 'authenticate_login':    // comes here when user press 'Sign In' button on the login page
	  
	       $args['forget_password'] = "0";
           $objCredentials = new credentials();

           // Read the inputs from the Login form and do validation
           // Form values are directly read from the $_POST array by form validating function
           // objCredentials is passed by reference. Thus the input values will be filled in the original object itself

           $errmsg = $auth_helper->validateLoginForm($objCredentials);

           // if error on server-side validation, return back to login page and show error
	  
	 	  
           if(is_array($errmsg)) {
             if(sizeof($errmsg) >= 1) {
                 $args['view_name'] = "auth_view_login";
                 $app_helper->showView($args, $Module, $errmsg);
                 break;
             }
           }

           // authenticate the user with credentials provided.  user_id is set in SESSION within the authenticate function.
           $authenticated = $auth_helper->authenticate($objCredentials->getUsername(), $objCredentials->getPassword());
	  
           if(!$authenticated) {
                $errmsg['authentication'] = 'MSGVAL_LOGIN_FAILED';
                $args['view_name'] = "auth_view_login";
                $app_helper->showView($args, $Module, $errmsg);
           }
           else {

                header("Location: ".$_SESSION['EMRP_BASE_URL'].$cfg_chmhomecontroller."?taskname=show_homepage");
                exit();
           }
           break;

      
      case 'show_forgot_password':
          
	       $errmsg = array();	
           $args['view_name'] = "auth_view_forget_password";
	     
	       $app_helper->showView($args,$Module,$errmsg);	     
	     
           break;


      case 'logout':

           unset($_SESSION['a3portal_userid']);  // logout the user and then proceed to the next case to show the login page
		   unset($_SESSION['menu_left']);
	       unset($_SESSION['menu_left_activeitem']);
	       unset($_SESSION['menu_top_activeitem']);

           // Continue to the next case to show the login page
          
    
      default: // Show the login page by default
           $args['view_name']= 'auth_view_login';
           $arrErrMsg = array();
           $app_helper->showView($args, $Module, $arrErrMsg);
           break;
    }

?>