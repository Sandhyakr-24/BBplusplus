<?php

    session_start();
    
    class auth_view_forget_password {
        
    function show($args ="", $arrErrorMsg = "") {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..:: eLIBRIM : Forgot Password ::..</title>
<?php
 include($_SESSION[LIBRIM_BASE_DIR]."/app/views/includes/library_header.php");
 
?>
</head>
<body  class="login">
<form action="<?php echo $_SESSION[LIBRIM_BASE_URL].'modules/auth/auth_controller.php';?>" method="post" name="forgot_password" id="forgot_password">
   
  <input type="hidden" name="hdnIdchk" id="hdnIdchk" />
  
  <div align="right" style="width:100%; padding-top:200px; margin-left:-250px;">
    <!-- pannel start here -->
    <div style="width:320px; height:100%; border:0px solid red;">
      <div class="login_bg">
        <div class="left_login_curve"></div>
        <div class="login_logo">            
            <img src="<?php echo $_SESSION[LIBRIM_BASE_URL].'app/views/css/blueTheme/login/log_logo.gif';?>" width="100" height="40" border="0" />            
        </div>
        <div class="right_login_curve"></div>
      </div>



      <div class="container">
        <div style="border:0px solid red;">
          <!--login Cnt Starts here -->
		  <div id="hdrLogCnt" align="center" class="bold">
                    
                    <?php
        
            echo $app_strings['TITLE_LOGIN'];
        
        
        ?>
                  </div>
          <!--Forgot Password Cnt Starts here -->
          
            
          <div id="forgtPwsdDiv" style="display:block;">
            
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="blank">
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td width="10%" class="descTxt">User Name : </td>
                          <td class="spacerform">&nbsp;</td>
                          <td width="80%">
			    <input class="validate[required]" name="username" id="username" type="text" style="width:97%;" value="" />
			  </td>
                          <td class="spacerform" width="10%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
              
              <td colspan="4" align="center">
                <div id="err_forget">
                <span class="errorMsg"><?php
                      foreach($arrErrorMsg as $errMsg) {
                        echo $app_strings[$errMsg];
			
                        break; // display only the first error message
                      }
                  ?></span>
                </div>
              </td>
              
            </tr>
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="4" class="spacer4">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right"><a href="<?php echo $_SESSION['LIBRIM_BASE_URL'].'modules/auth/auth_controller.php?taskname=show_login';?>" >Login</a></td>

                          <td>&nbsp;</td>
                          <td>
			    <table>
				<tr>
				<td>
				    
			    <?php
			      $cancelURL=$_SESSION['LIBRIM_BASE_URL'].'modules/auth/auth_controller.php?taskname=show_login';
			    ?>
			    <input type="submit" name="btn_reset" value="" onclick="setTaskName('reset_user_forgot_password')" title=" Reset " class="btn_reset" />
                            <input type="hidden" name="taskname" id='taskname' value="reset_user_forgot_password">
                            &nbsp;&nbsp;
			    </td>
				<td>
			    
                            <input type="button" name="btn_cncl" value="  "  title=" Cancel " class="btn_cncl" onclick="document.location.href='<?php echo $cancelURL;?>'" />
				</td>
				</tr>
				</table>
			  </td>
                          <td>&nbsp;
			  </td>
                        </tr>
                       
                        
                      </table>
		      
                    </div>
       
          <!--Forgot Password Cnt Ends here -->          
          </div>
      </div>
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
          <td width="10" class="left_round_corner">&nbsp;</td>
          <td class="round_corner_border">&nbsp;</td>
          <td width="10" class="right_round_corner">&nbsp;</td>
        </tr>
      </table>
    </div>
    <!-- pannel end here -->
  </div>
</form>
</body>
</html>
<?php
   include($_SESSION[LIBRIM_BASE_DIR]."/app/views/includes/include_scripts.php");
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
        
        
         })
         
        
        
      });
 
 </script>
 
 
 
 	
<?php
    }
    
    }

?>
