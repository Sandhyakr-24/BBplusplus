<div class="container-fluid" style="width:100%;/*background-color:#184e8e;*/background:linear-gradient(to right, rgb(13,75,126)0%, rgb(73,155,234)49%,rgb(44,114,180)100%);margin:0px;padding:1px;height:75px;"><img src="<?php echo $_app_bootstrapdir_url;?>/assets/img/logo.png" style="width:75px;">

    <div class="gka-dropdown-hover gka-hide-small gka-right"> 
      <button  class="gka-button gka-hide-small gka-padding-large gka-card-4" title="My Account">User Name 
      &nbsp;<img src="<?php echo $_SESSION['EMRP_BASE_URL'];?>/app/views/images/avatar2.png" alt="My Account" class="gka-circle" style="height:50px;width:50px"></button>
      <div class="gka-dropdown-content gka-card-4 gka-bar-block" style="width:220px"> 
        <a href="#" class="gka-bar-item gka-button">Profile</a> 
        <a href="#" class="gka-bar-item gka-button">Change Password</a> 
        <a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_logincontroller; echo $cfg_logincontroller;?>?taskname='show_login'" class="gka-bar-item gka-button">Logout</a> 
      </div>
    </div>
 
</div>

<div id="block_menubar">
<div class="container" id="container_menubar" style="width:100%;max-width:100%;padding:0px;padding-right:0px;">
<div class="row" id="row_menubar" style="width:100%;margin:0px;height:30px;">
<div class="col-md-12" id="column_menubar" style="width:100%;height:10px;padding:0px;background-color:#FFFFFF;">
<div class="navbar navbar-expand-md navbar-dark bg-dark" style="width:100%;height:30px;">
<div class="container"><span class="text-white d-md-none">EMRP</span><button class="btn btn-link navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav"><span class="navbar-toggler-icon"></span></button>
<div id="main-nav"
    class="navbar-collapse collapse">
    <ul class="navbar-nav nav-fill w-100">
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_chmhomecontroller; echo $cfg_chmhomecontroller;?>?taskname='show_homepage'" class="nav-link">CHMM Dashboard</a></li>
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_chmreportscontroller; echo $cfg_chmreportscontroller;?>?taskname='show_reports_reportshome'" class="nav-link">CHM Reports</a></li>
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_chmchartscontroller; echo $cfg_chmchartscontroller;?>?taskname='show_chartshome'" class="nav-link">CHM Charts</a></li>
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_prmhomecontroller; echo $cfg_prmhomecontroller;?>?taskname='show_homepage'" class="nav-link">PRM Dashboard</a></li>
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_prmreportscontroller; echo $cfg_prmreportscontroller;?>?taskname='show_reports_reportshome'" class="nav-link">PRM Reports</a></li>
    <li class="nav-item"><a href="<?php echo $_SESSION['EMRP_BASE_URL'];?><?php global $cfg_prmchartscontroller; echo $cfg_prmchartscontroller;?>?taskname='show_chartshome'" class="nav-link">PRM Charts</a></li>
    </ul>
</div>
    
    
    
    
    
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div id="block_linebelowheader">
    <div class="container" id="container_linebelowheader" style="width:100%;max-width:100%;padding:0px;padding-right:0px;">
    <div class="row" id="row_linebelowheader" style="width:100%;margin:0px;">
    <div class="col-md-12" id="column_linebelowheader" style="width:100%;height:10px;padding:0px;background-color:#0000FF;"></div>
    </div>
    </div>
    </div>