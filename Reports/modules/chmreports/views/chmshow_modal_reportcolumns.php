<!--  The Modal window for Columns selection starts -->
<div class="modal fade" role="dialog" tabindex="-1" id="modalshowcolumns<?php echo $allReports['report_id'];?>">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h4>Choose Columns</h4>
</div>
<div class="modal-body">

<?php
    $reports_helper = new chmreports_helper();
    $app_helper = new app_helper();
    $reportid = $allReports['report_id'];
    $args['arrAllColumns'] = $reports_helper->getAllColumnsByReportId($reportid);
    //print_r($args['arrAllColumns']);
    $args['arrAllwhereclause'] = $reports_helper->getAllwhereclauseByReportId($reportid);
    //print_r($args['arrAllwhereclause']);
    
    // get all entries from report_master_wc_tbl to know which where_clause filter columns need drop-down value from the support table
    $args['arrMaster'] = $reports_helper->getAllMasterRecords();
    //print_r($args['arrMaster']);
    $arrMaster = array();
    
    foreach($args['arrMaster'] as $arrMas){
        $arrMaster[$arrMas['wc_column_name']] = $arrMas; 
    }
    

    $p = 0;
    $arrMasterSelect = array();
    foreach($args['arrAllwhereclause'] as $checkMaster) {

        if($arrMaster[$checkMaster['report_whereclause_column_name']]!= "") { // If there is an entry in the report_master_wc_tbl for this whereclause field
            
            $masterWCrec = $arrMaster[$checkMaster['report_whereclause_column_name']];

            //$query = "select ".$masterWCrec['wc_column_name'].",".$masterWCrec['support_column_name']." from ".$masterWCrec['table_name'];
            $query = "select ".$masterWCrec['support_column_name']." from ".$masterWCrec['table_name'];
            
            if($checkMaster['column_data_prefix'] != ""){
                $query.= " where  status_code like '".$checkMaster['column_data_prefix']."%' ";
            }

            $execResult = $app_helper->executeConstructedQuery($query);
 
            $optionscnt = 0;
            foreach($execResult as $execRes){
                $arrMasterSelect[$p][$optioncnt] = $execRes[$masterWCrec['support_column_name']];
                $optioncnt++;
            }
        }
        
        $p++;
    } 
    // print_r($arrMasterSelect);
?>
                              <form action="<?php echo $_SESSION['EMRP_BASE_URL'].$cfg_chmreportscontroller.'?taskname=show_report_view_datatable_custom&report_id='.$allReports['report_id'];?>>", method="post" name="columnsselectform" id="columnsselectform">
                    					<!--  Column names table starts here -->
                    					<div id="viewAllColumns"> 
                    					
                    					     <table>
                    					      <tr>
                    					        <th style="width:5%"></th>
                    					        <th style="width:20%"></th>
                    					        <th style="width:5%"></th>
                    					        <th style="width:20%"></th>
                    					        <th style="width:5%"></th>
                    					        <th style="width:20%"></th>
                    					        <th style="width:5%"></th>
                    					        <th style="width:20%"></th>
                    					       </tr> 
        									              
            									  <?php 
            									    $columnscount = 0;
            									    $entriesperrow = 4;
            									    foreach($args['arrAllColumns'] as $allColumns) { 
            									        if(($columnscount % $entriesperrow ) == 0) { ?>
            									                 <tr>
            									       <?php }?>
													                <td><input type="checkbox" name="col_<?php echo $allColumns[report_column_name]?>" id="col_<?php echo $allColumns[report_column_name]?>" value="<?php echo $allColumns[report_column_name]?>" checked='checked'> </td>
              										                <td><?php echo $allColumns[report_column_label]?></td>
              										   <?php 
              										         $columnscount++;
              										         if(($columnscount % $entriesperrow ) == 0) { ?>
            									                 </tr>
            									       <?php }?>
              									  <?php 
              									      
            									    } ?>

                    					      </table>
                    					      
                    					   </div> <!--  Column names table ends here -->
                    				
                    				</div> <!--  Modal body ends here -->
                    					   
                  					<div id="viewFilterColumns"> <!--  Where-clause filter column names div starts here -->
                    					
                    				       <div class="modal-header">
												<h4>Choose Filters</h4>
											</div>
									
									       <div class="modal-body">
												<table>
												  <tr>
										  			<th style="width: 40%;"></th>
										  			<th style="width: 30%;"></th>
										  			<th style="width: 30%;"></th>
			                                      </tr>
										  			<?php 
										  			     $reccnt = 0;
										  			     foreach($args['arrAllwhereclause'] as $allWhereclause) { ?>
										  					<tr>
										  			  			<td style="width: 40%;"><?php echo $allWhereclause['report_whereclause_column_label']; ?></td>
										  			  			
										  			  			<?php 
										  			  			      if(sizeof($arrMasterSelect[$reccnt]) != 0) { ?>
										  			  			            <td style="width: 30%;">
										  			  			            	<select name="<?php echo $allWhereclause['report_whereclause_column_name'];?>" id=name="<?php echo $allWhereclause['report_whereclause_column_name'];?>">
										  			  			              		<optgroup label="" name="<?php echo $allWhereclause['report_whereclause_column_name'];?>" id="<?php echo $allWhereclause['report_whereclause_column_name'];?>" >
										  			  			              		    <option value="select">All</option>
										  			  			              			<?php
										  								  			  			                              
										  			  			                              foreach($arrMasterSelect[$reccnt] as $optionvalues) {?>
										  			  			            					<option name="<?php echo $optionvalues;?>" id="<?php echo $optionvalues;?>"><?php echo $optionvalues;?></option>
                                                                              			<?php } ?>
										  			  			              		</optgroup>
										  			  			            	</select>
										  			  			            </td>
										  			  			<?php }
										  			  			      else if($allWhereclause['wc_datatype'] == 'varchar') { ?>
										  			  			       		<td style="width: 30%;"><input type="text"  name="<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
										  			  			<?php } 
										  			  			      else if($allWhereclause['wc_datatype'] == 'datetime') { ?>
										  			  			 
										  			  			       		<td style="width: 30%;"><input type="date" name="fromdate_<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
									  			  			       			<td style="width: 30%;"><input type="date" name="todate_<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
										  			  			<?php } 
										  			  			      else if($allWhereclause['wc_datatype'] == 'integer') { ?>
										  			  			 
										  			  			       		<td style="width: 30%;"><input type="number" name="fromvalue_<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
									  			  			       			<td style="width: 30%;"><input type="number" name="tovalue_<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
										  			  			<?php } 
										  			  			      else { ?>
										  			  			         	<td style="width: 30%;"><input type="text" name="<?php echo $allWhereclause['report_whereclause_column_name']; ?>" id="<?php echo $allWhereclause['report_whereclause_column_name']; ?>"></td>
										  			  			<?php } ?>
										            		</tr>
										            <?php 
										                   $reccnt++;
										  			     } ?>
												</table>
											</div>

									</div> <!--  Where-clause filter column names div ends here -->
					
			                    					
                    				<div class="modal-footer">
                 				   
                    				   <button type="submit" class="btn btn-primary">View Report</button>
                    				   <!--  <button class="btn btn-light close" type="button" data-dismiss="modal">Cancel </button> -->
                                       <button class="btn btn-primary" type="button" data-dismiss="modal">Cancel </button>
                                       
                    				 </div>
                    				 
                    			</form>	
                    			
                				</div>
            				</div>
        				</div>
    				</div> <!--  The Modal window for Columns selection ends  -->
