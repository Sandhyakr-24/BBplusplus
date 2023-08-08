<?php

    session_start();
    
    class auth_view_login {
        
    function show($args ="", $arrErrorMsg = "") {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..:: eLIBRIM : Login ::..</title>
<?php
 include($_SESSION[LIBRIM_BASE_DIR]."/app/views/includes/library_header.php");
 
?>
</head>
<body>

<noscript><meta http-equiv="refresh" content="0;url=<?php echo $_SESSION[APP_BASE_URL];?>/enablejavascript.php"></noscript>

  <form action="<?php echo $_SESSION[LIBRIM_BASE_URL].'modules/auth/auth_controller.php';?>" method="post" name="login" id="login">
  
  
  <div align="right" style="width:100%; padding-top:100px; margin-left:-250px;">


    <!-- pannel start here -->
    <div style="width:320px; height:100%; border:0px solid red;">
      <div class="login_bg">
        <div class="left_login_curve"></div>
        <div class="login_logo">            
            <img src="<?php echo $_SESSION[LIBRIM_BASE_URL].'app/views/images/eLIBRIMlogo.png';?>" width="100" height="40" border="0" />            
        </div>
        <div class="right_login_curve"></div>
      </div>

      <div class="container">
           <div align="center">
                  <img  src="<?php echo $_SESSION[LIBRIM_BASE_URL].'libraries/'.$_SESSION['library_code'].'/libraryimages/'.$_SESSION['library_logo_filename'];?>" width="80" height="60" />
           </div>
	       <div  align="center"> <h1 class="heading"><?php echo $_SESSION['library_name']; ?></h1> </div>
		   <br/><br/>

        <div style="border:0px solid red;">
          <!--login Cnt Starts here -->
		  <div id="hdrLogCnt" align="center" class="bold">
                    
                    <?php
        
            echo $app_strings['TITLE_LOGIN'];
        
                ?>
                  </div>
        <!--login Cnt Starts here -->
        <form action="" method="post" name="login" id="login" onsubmit="return validateUserName()">
            
            
            <div id="loginDetDiv" style="display:block;">
            
            
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
              <td width="80%"><input class="validate[required] inptBx" name="txtUsrName" id="txtUsrName" type="text" style="width:97%;" value="" /></td>
              <td class="spacerform" width="10%">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" class="spacer4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" class="spacer4">&nbsp;</td>
            </tr>
            <tr>
              <td class="descTxt">Password : </td>
              <td class="spacerform">&nbsp;</td>
              <td><input class="validate[required]" name="txtPswd" id="password" type="password" class="inptBx" style="width:97%;" /></td>
              <td></td>
            </tr>
            <tr>
              <td colspan="4" class="spacer4">&nbsp;</td>
            </tr>
            <tr>
              
              <td colspan="4" align="center">
                <div id="err_login">
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
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td align="left" valign="middle"><input type="submit" name="btn_login" value="  "  title=" Login "  class="btn_login" />
              <input type="hidden" name="taskname" id='taskname' value="authenticate_library_login">
              <a href="<?php echo $_SESSION['LIBRIM_BASE_URL'].'modules/auth/auth_controller.php?taskname=show_forgot_password';?>" onclick="javascript:forgotPwsd();">Forgot Password</a></td>
              <td>&nbsp;</td>
            </tr>
            
          </table> 
           </div>
       
          <!--login Cnt ends here -->
          
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


//login validation

function setuserName(){
	var userName = document.getElementById('txtUsrName');
	userName.focus();
}



    
	
 $(document).ready(function(){
    
	$("#login").validationEngine({
	    
	    inlineValidation: true,
	    
	    scroll : false,
       
	    success :  false,
       
	    failure : function() {
		
	    }        
        });
	
      });

 </script>
 
 
 
 <script>
 
 

 
 
 </script>	
<?php
    }
    
    }

?>
