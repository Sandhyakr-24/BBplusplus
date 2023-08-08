<?php


   // whenever the site is down for maintenance make this flag 'on'. Traffic will then be redirected to maintenance message page
   $cfg_maintenance = 'off'; 
   $cfg_maintenancepage = 'undermaintenance.php';
  
   // Use HTTPS  or not
   $cfg_usehttps = false;  // On LIVE server set this to 'true' (if the server is https enabled). While testing on local machines this may be set to false
                           // This flag is used in main.php (index.php) to decide the base url
   
   // for __autoload. The installation directory of eVidya. Used in /app/boot/checksandincludes.php
   $cfg_autoload_includepath_rootdirectory = 'emrp'; 

 
   // Log settings
   $cfg_loggingOn = true;  // 'false' to turn off logging
   $cfg_globalLogLevel = 7; // ERROR
   $cfg_logfilename = "emrplog.log";
   $cfg_logrolloversize = 100; // 100MB
   $cfg_maxarchivelogfiles = 5; // How many logfiles should be preserved before overwritting (excluding current logfile)

   // Error Message Display
   $cfg_ShowDetailedErrorMsgOnScreen = true; // if 'true', detailed error message also will be shown on the screen. 
                                             // Otherwise, this detailed message is only written to the log file.

   // valid file extensions
   $cfg_valid_imagefile_extensions    = "jpeg|jpg|pjpeg|gif|png"; 
   $cfg_valid_documentfile_extensions = "doc|docx|txt|pdf";
   
   // Controller Page links
   // htaccess entry: RewriteRule ^emrpregistration$ modules/reg/reg_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_registrationcontroller = 'emrpregistration';
   // htaccess entry: RewriteRule ^emrplogin$ modules/auth/auth_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_logincontroller = 'emrplogin';
   // htaccess entry: RewriteRule ^prmemrphome$  modules/home/prmhome_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_prmhomecontroller  = 'prmemrphome';
   // htaccess entry: RewriteRule ^prmemrpreports$  modules/reports/prmreports_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_prmreportscontroller = 'prmemrpreports';
   // htaccess entry: RewriteRule ^prmemrpcharts$  modules/charts/prmcharts_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_prmchartscontroller = 'prmemrpcharts';
   
   // htaccess entry: RewriteRule ^chmemrphome$  modules/home/chmhome_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_chmhomecontroller  = 'chmemrphome';
   // htaccess entry: RewriteRule ^chmemrpreports$  modules/reports/chmreports_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_chmreportscontroller = 'chmemrpreports';
   // htaccess entry: RewriteRule ^chmemrpcharts$  modules/charts/chmcharts_controller.php?friendlyurl=$1&%{QUERY_STRING}
   $cfg_chmchartscontroller = 'chmemrpcharts';

  
?>
