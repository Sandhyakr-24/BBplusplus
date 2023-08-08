<?php

 session_start();
    
 class chmshow_report_view_datatable {
        
    function show($args ="", $arrErrorMsg = "") {
        
        $selectedcolumns_json = json_encode($args['selectedcolumns']);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMRP Reports Portal</title>
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_header.php"); 
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_datatable_cssfiles.php"); ?>
          
    <style>
        .dataTables_wrapper .dt-buttons {
            float:right;  
            text-align:center;
        }

        .dataTables_wrapper .dataTables_filter {
            float:left;  
            text-align:left;
        }
    </style>
</head>

<body>

     <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_headerpanel.php"); ?>

    <div>
        <div class="container" style="margin:10px;padding:0px;"> <!--  keeping margin 10px to make sure the paging numbers at the bottom of the datatable are visible -->
            <div class="row" style="width:100%;min-width:100%;margin:0px;height:100%;">
 
                 <!--  can include  'emrp_sidemenupanel.php' here, if sidebar menu is required -->
 
 
                <div class="col" id="column-reportview" style="width:100%">
                    <div class="row" id="row-reportviewrow1" style="width:100%;margin:0px;padding:2%;">
                        <div class="col" id="column1-reportviewrow1" style="background-color:#ffffff;background-size:cover;background-repeat:repeat;">

<div class="container" style="width:100%;margin:0px;padding:0px;">
    <div class="row" style="width:100%;margin:2px;">
  
        <div class="col-md-12 col-md-offset-1" style="width:100%">

            <div class="panel panel-default style="width:100%">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-12">
                    <h4 class="panel-title"><?php echo $args['report_name'];?></h4>
                  </div>
                  <div class="col col-xs-12 text-right">
                    <!-- <button type="button" class="btn btn-sm btn-primary btn-create">Add to MyReports</button> -->
                    
                  </div>
                </div>
              </div>
             </div>
              
              <div class="panel-body" style="width:100%">
              
                    <!-- Data table starts -->
                    
                     <table id="reportdata" class="table table-striped table-bordered" style="width:100%"> 
        				<thead style="background-color: #a1a1a1">
            				<tr>
            				  <?php foreach($args['selectedcolumns'] as $selectedcolumn) {?>
                						<th name="<?php echo $selectedcolumn;?>"><?php echo $selectedcolumn;?></th>
               				  <?php } ?>
            				</tr>
        				</thead>
        				
        				<tbody>
        				

    				</table>
                    <!-- Data table ends -->
                    
              </div>
              <div class="panel-footer">
                <div class="row">

              </div>
            </div>

</div></div></div></div>

                    </div>
                    <!-- 
                    <div class="row" id="row-reportviewrow2" style="width:100%;margin:0px;padding:5%;">
                        <div class="col" id="column1-reportviewrow2" style="background-color:#ffffff;background-size:cover;background-repeat:repeat;"></div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
    
    
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_footer.php");  
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_scripts.php"); 
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_datatable_scripts.php");
     ?>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.7.4/metisMenu.min.js"></script>

<script>    


    $(document).ready(function() {

       
    var table = $('#reportdata').DataTable( {
        scrollY: 300,
        "sScrollX": "100%",
        "sScrollXInner":"110%",
        "bScrollCollapse":true,
        "iDisplayLength": 50,
        language: {
            search: "_INPUT_", // this will remove the 'Search' label in front of the serach box
            searchPlaceholder:"Search...",
            "lengthMenu": 'Show <select>'+
            '<option value="10">10</option>'+
            '<option value="25">25</option>'+
            '<option value="50">50</option>'+
            '<option value="100">100</option>'+
            '<option value="200">200</option>'+
            '<option value="500">500</option>'+
            '<option value="-1">All</option>'+
            '</select>'
        },
        "dom": '<lf<t>ip>B', // Buttons, Length and filter above, information and pagination below table. Ref:https://datatables.net/reference/option/dom
       // dom: 'Bfrtip',
        buttons: [
        	 { extend: 'excel', text: 'Excel' },
        	 { extend: 'csv', text: 'CSV' },
        	 { extend: 'pdf', text: 'PDF' },
        	 { extend: 'colvis', text: 'Show/Hide Columns' }
        ],
        // colReorder: true, // can click and drag columns to change the order. This is disabled as this will not work with ajax 
        paging: true,
        // For Server side processing. To load data only shown in the page than loading entire data
        // Ref: https://datatables.net/manual/server-side, https://datatables.net/examples/server_side/simple.html
        processing: true, 
        serverSide: true,
        ajax: {
             url: "<?php echo $_SESSION['EMRP_BASE_URL'];?>modules/chmreports/chm_ajaxssp_getdatatablerecords.php",
             type: 'POST'
            //params: columnVals

        }
    } );

    table.buttons().container()
    .insertBefore( '#reportdata_filter' );
} );
</script>

<script>
table.buttons().container()
.appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );

</script>

</body>

</html>

<?php
    }
    
    }

?>