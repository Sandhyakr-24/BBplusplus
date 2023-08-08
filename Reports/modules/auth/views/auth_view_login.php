<?php

    session_start();
    
    class auth_view_login {
        
    function show($args ="", $arrErrorMsg = "") {

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMRP Reports Portal</title>

<?php
 include($_SESSION[EMRP_BASE_DIR]."/app/views/includes/emrp_header.php");
 
?>
</head>

<body>
    <div style="background-image:url(&quot;<?php global $_app_bootstrapdir_url;  echo $_app_bootstrapdir_url;?>/assets/img/homescr_bg.png&quot;);height:650px;background-position:center;background-size:cover;background-repeat:no-repeat;">
        <div class="d-flex justify-content-center align-items-center" style="height:inherit;min-height:initial;width:100%;position:absolute;left:0;background-color:rgba(30,41,99,0.53);">
            <div data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100" data-aos-once="true" class="login-card" style="font-family:Roboto, sans-serif;">
                <p class="profile-name-card"> <i class="fa fa-unlock-alt d-inline" style="width:0;height:0;font-size:56px;color:rgb(104,145,162);"></i></p>
                <form class="form-signin" action="<?php global $cfg_authcontroller; $_SESSION['EMRP_BASE_URL'].$cfg_authcontroller;?>" method="post">
                        <span class="reauth-email" style="margin:11px;"> </span>
                        <input class="form-control" type="email" required="" placeholder="Email address" autofocus="" name="inputEmail" id="inputEmail">
                        <input class="form-control" type="password" required="" placeholder="Password" name="inputPassword" id="inputPassword">
                        <button class="btn btn-primary btn-block btn-lg btn-signin" type="submit" style="font-family:Roboto, sans-serif;font-size:16px;font-weight:normal;font-style:normal;">Sign in</button>
                        
                        <input type="hidden" name="taskname" id='taskname' value="authenticate_login">
                </form>
                <p class="text-center"
                    style="color:rgb(73,80,87);font-size:11px;">
                    <a href="#">Reset Password</a>
                </p>
            </div>
            <div class="d-flex align-items-center order-12" style="height:200px;">
                <div class="container">
                    <h1 class="text-center" style="color:rgb(242,245,248);font-size:56px;font-weight:bold;font-family:Roboto, sans-serif;">EasyMath</h1>
                    <h1 class="text-center" style="color:rgb(242,245,248);padding-top:0.25em;padding-bottom:0.25em;font-weight:normal;">Reports Portal</h1>
                </div>
            </div>
        </div>
    </div>

    <?php 
       include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_scripts.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
</body>

</html>
<?php
    }
    
    }

?>
