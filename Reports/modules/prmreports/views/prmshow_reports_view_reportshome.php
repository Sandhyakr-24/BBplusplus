<?php

    session_start();
    
    class prmshow_reports_view_reportshome {
        
    function show($args ="", $arrErrorMsg = "") {

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMRP Reports Portal</title>
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_header.php"); ?>
</head>

<body>
 
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_headerpanel.php"); ?>
    
    <div>
        <div class="container" style="margin:0px;padding:0px;width:100%;height:100%; margin-bottom:0%">
            <div class="row" style="width:100%;min-width:100%;max-width:100%;margin:0px;height:100%;">
            
               <!--  can include  'emrp_sidemenupanel.php' here, if sidebar menu is required -->
   
                 <div class="col" id="column-reportslist" style="max-width:110%;width:100%;">
                    <div class="row" id="row-reportslistrow1" style="width:100%;margin:0px;padding:2%;">
                        <div class="col" id="column1-reportslistrow1" style="background-color:#ffffff;background-size:cover;background-repeat:repeat;width:100%">
                            <ul class="list-unstyled metismenu" id="mm-example-1">
                           <?php 
                                $previous_groupid = 0;
                                $reportscount = 0;
                                $isgrouptitle = false;
                                
                                foreach($args['arrAllReports'] as $allReports) { 
                                    $reportscount = 0;
                                    if($previous_groupid == 0) { // Make the first group title style as 'active' to show it expanded
                                        $previous_groupid = $allReports['group_id'];
                           ?>
                                		<li class="active"><a href="#" class="has-arrow" aria-expanded="true"><?php echo $allReports['group_name']; ?></a>
                                		   	<ul class="list-unstyled" aria-expanded="true">
                              <?php } 
                                    else if($previous_groupid != $allReports['group_id']) { // Other group titles are not expanded
                                        $isgrouptitle = true;
                                        $previous_groupid = $allReports['group_id'];
                              ?>
                                           </ul> <!-- First close the ul and li of the previousgroup -->
                                		</li>
                                		
                                		<!--  now start the li and ul for next group (keep class=active if all groups should be shown expanded initially) -->
                                        <li class="active"><a href="#" class="has-arrow" aria-expanded="false"><?php echo $allReports['group_name']; ?></a>
                                        	<ul class="list-unstyled" aria-expanded="false">
                              <?php } 
                                    else {
                                        $isgrouptitle = false; 
                                    }
                              ?>
                                       		  <li><a id="<?php echo $allReports['report_id'];?>"  href="#modalshowcolumns<?php echo $allReports['report_id'];?>" data-toggle="modal" data-backdrop="static"><img src="<?php echo $_app_images_dir_url;?>/ic_edit.png"/></a>
                                       		  <a href="<?php echo $_SESSION['EMRP_BASE_URL'].$cfg_prmreportscontroller;?>?taskname=show_report_view_datatable_default&report_id=<?php echo $allReports['report_id'];?>" title="<?php echo $allReports['report_description']; ?>"><?php echo $allReports['report_name']; ?> </a></li>
 
                               
                           <?php }  // End of the for loop ?>     
                                                         
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="row" id="row-reportslistrow2" style="width:100%;margin:0px;padding:2%;">
                        <div class="col" id="column1-reportslistrow2" style="background-color:#ffffff;background-size:cover;background-repeat:repeat;"></div>
                          <?php  foreach($args['arrAllReports'] as $allReports) { 
      				        include($_SESSION['EMRP_BASE_DIR']."/modules/prmreports/views/prmshow_modal_reportcolumns.php"); 
                          }
     				      ?>
     				
                  </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_footer.php");  ?>
    
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_scripts.php"); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.4/metisMenu.min.js"></script>
    <script src="<?php echo $_app_bootstrapdir_url;?>/assets/js/MetisMenu-BS41.js"></script>
    
</body>

</html>


<?php
    }
    
    }

?>