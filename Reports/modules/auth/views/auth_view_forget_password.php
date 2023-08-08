<?php

    session_start();
    
    class auth_view_forget_password {
        
    function show($args ="", $arrErrorMsg = "") {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wings2Roots : Family Connections</title>
<?php  include($_SESSION['W2RAPP_BASE_DIR']."/app/views/includes/header.php");?>
<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.wings2Roots #sidebar1, .wings2Roots #sidebar2 { padding-top: 0px; padding-left: 10px;  }
.wings2Roots #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
</head>
<body  class="wings2Roots">
<form action="<?php echo $_SESSION['W2RAPP_BASE_URL'].'modules/auth/auth_controller.php';?>" method="post" name="forgot_password" id="forgot_password">

<div id="container">
  <div id="header">
<?php  include($_SESSION['W2RAPP_BASE_DIR']."/app/views/includes/body_header.php");?>  </div>
  <!-- end #header -->
  <!-- Main Container Starts here -->
  <div id="mnContainer">  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><div id="setup_Curvetable" style="width:65%;">
            <!-- Top header Curve : Div starts here -->
            <div class="corners_top_CnvrGrdHdr"> <span class="corner_top_left_CnvrGrdHdr"></span> <span class="table_caption">Forgot Password</span> <span class="corner_top_right_CnvrGrdHdr"></span> <span class="caption_flag"> </span> </div>
            <!-- Top header Curve : Div ends here -->
            <!--  MainContent Curve : Div starts here -->
            <div class="corners_mainCnt">
         
                  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="blank"> 
                   <?php
		  
		 
		    if(sizeof($arrErrorMsg) > 0) {
			
		  ?> <tr>
                        <td class="spacerLft10" colspan="3" align="left" > 
		  
			  <h4  id="errMsg">
				    <?php
					foreach($arrErrorMsg as $key => $errMsg) {
					    
					  echo $app_strings[$errMsg];
					  
					  break; // display only the first error message
					}
				    ?>
			       </h4>
			  </td>
                       </tr> 
		   <?php } ?> 
                       <tr>
                          <td width="10%" class="descTxt">User Name : </td>
                          <td class="spacerform">&nbsp;</td>
                          <td width="80%">
			    <input class="validate[required]" name="username" id="username" type="text" style="width:50%;" value="" />
			  </td>
                         
                        </tr>
		       <tr>
				<td colspan="3">
				    
			    <?php
			      $cancelURL=$_SESSION['W2RAPP_BASE_URL'].'modules/auth/auth_controller.php?taskname=show_login';
			    ?>
			    <input type="submit" name="btn_reset" value="Reset" onclick="setTaskName('reset_user_forgot_password')" title=" Reset " class="btn_reset" />
                            <input type="hidden" name="taskname" id='taskname' value="reset_user_forgot_password" />
                            <input type="button" name="btn_cncl" value=" Cancel "  title=" Cancel " class="btn_cncl" onclick="document.location.href='<?php echo $cancelURL;?>'" />
				
			  </td>
                          
                        </tr>
                      
                    </table>
	    </div>
     <div class="corners_bottom"><span class="corner_bottom_left"></span><span class="corner_bottom_right"></span></div>
           
    </div>
	</td></tr></table>
             
         
  </div>
  <!-- Main Container Ends here -->
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <br class="clearfloat" />
  <?php  include($_SESSION['W2RAPP_BASE_DIR']."/app/views/includes/body_footer.php");?> <!-- end #footer -->
  <!-- end #container -->
</div>
</form>
</body>
</html>
<?php
   include($_SESSION['W2RAPP_BASE_DIR']."/app/views/includes/include_scripts.php");
 ?>
 
 <script language="javascript">
 
function setTaskName(taskname) {
    document.getElementById('taskname').value=taskname;
    
}
//login validation

    $(document).ready(function(){
    
	$("#forgot_password").validationEngine({
   
        inlineValidation: true,
        
        scroll : false,
   
        success :  false,
   
        failure : function() {
	    
	}
         });
         
        
      });
 
 </script>
<?php
    }
    
    }

?>
