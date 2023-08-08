<?php
     session_start();
     // the url paths

     global $_app_css_dir_url;
     global $_app_images_dir_url;
     global $_app_scripts_dir_url;

     global $_system_images_dir_url;
     global $_system_data_dir_url;
     global $_system_userdata_dir_url;
     
     global $_app_bootstrapdir_url;

     global $_app_datatable_css_dir_url;
     global $_app_datatable_scripts_dir_url;
     
     global $_app_mdchart_css_dir_url;
     global $_app_mdchart_scripts_dir_url;
     
     $_app_css_dir_url        = $_SESSION['EMRP_BASE_URL']."app/views/css";
     $_app_images_dir_url     = $_SESSION['EMRP_BASE_URL']."app/views/images";
     $_app_scripts_dir_url    = $_SESSION['EMRP_BASE_URL']."app/views/scripts";
     
     $_system_images_dir_url  = $_SESSION['EMRP_BASE_URL']."system/systemimages";
     $_system_data_dir_url    = $_SESSION['EMRP_BASE_URL']."system/systemdata";
     $_system_userdata_dir_url   = $_SESSION['EMRP_BASE_URL']."system/systemuserdata";
     
     $_app_bootstrapdir_url = $_SESSION['EMRP_BASE_URL']."app/bootstrapdir";
     
     $_app_datatable_css_dir_url = $_SESSION['EMRP_BASE_URL']."app/views/css/datatablecss";
     $_app_datatable_scripts_dir_url = $_SESSION['EMRP_BASE_URL']."app/views/scripts/datatablescripts";
     
     $_app_mdchart_css_dir_url = $_SESSION['EMRP_BASE_URL']."app/views/css/mdchartcssdir/css";
     $_app_mdchart_scripts_dir_url = $_SESSION['EMRP_BASE_URL']."app/views/scripts/mdchartscripts";
     
     
     // absolute directory paths

     global $_app_css_dir;
     global $_app_images_dir;
     global $_app_scripts_dir;

     global $_system_images_dir;
     global $_system_data_dir;
     global $_system_userdata_dir;
     
     global $_app_bootstrapdir_dir;

     global $_app_datatable_css_dir;
     global $_app_datatable_scripts_dir;

     global $_app_mdchart_css_dir;
     global $_app_mdchart_scripts_dir;

     global $_app_mdchart_css_dir;
     global $_app_mdchart_scripts_dir;


     $_app_css_dir        = $_SESSION['EMRP_BASE_DIR']."/app/views/css";
     $_app_images_dir     = $_SESSION['EMRP_BASE_DIR']."/app/views/images";
     $_app_scripts_dir    = $_SESSION['EMRP_BASE_DIR']."/app/views/scripts";

     $_system_images_dir  = $_SESSION['EMRP_BASE_DIR']."/system/systemimages";
     $_system_data_dir    = $_SESSION['EMRP_BASE_DIR']."/system/systemdata";
     $_system_userdata_dir   = $_SESSION['EMRP_BASE_DIR']."/system/systemuserdata";
     
     $_app_bootstrapdir_dir = $_SESSION['EMRP_BASE_DIR']."/app/bootstrapdir";

     $_app_datatable_css_dir = $_SESSION['EMRP_BASE_DIR']."/app/views/css/datatablecss";
     $_app_datatable_scripts_dir = $_SESSION['EMRP_BASE_DIR']."/app/views/css/datatablescripts";

     $_app_mdchart_css_dir = $_SESSION['EMRP_BASE_URL']."app/views/css/mdchartscssdir/css";
     $_app_mdchart_scripts_dir = $_SESSION['EMRP_BASE_URL']."app/views/scripts/mdchartscripts";



?>