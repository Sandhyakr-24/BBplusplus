<?php

// File: ajaxssp_getdatatablerecords.php (get datatable records via ajax serverside processing)
// derived from original file server_processing.php
// Ref: example: https://datatables.net/examples/server_side/simple.html
// Ref: parameters: https://datatables.net/manual/server-side
// https://datatables.net/manual/server-side#Returned-data

session_start();

if(!isset($_SESSION['EMRP_BASE_DIR'])) {
    
    echo $app_strings['ERRMSG_INVALIDSESSION'];
    exit();
}

require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");



$em = new exceptionMgr(" ");
$em->logInfo("Enter server_processing: ");

$arrSelectedColumns = $_SESSION['chm_emrp_selectedcolumns'];

$table = $_SESSION['chm_emrp_db_report_view_name'];
// Table's primary key

$primaryKey =  $_SESSION['chm_emrp_uniquevaluecolumnname'];
$whereAll = $_SESSION['chm_emrp_wherequery'];

$em->logInfo("getajax: table:".$table." whereAll".$whereAll." primarykey:".$primaryKey);

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. 

$columns = Array();

$count = 0;
foreach($arrSelectedColumns as $selColumn) {
     
    $col = array('db' => $selColumn, 'dt' => $count);
    array_push($columns,$col);
    $count++;
}


//$em = new exceptionMgr(" ");
//$em->logInfo("server_processing: start: ".$_REQUEST['start']."  length: ".$_REQUEST['length']);

/*
$columns = array(
    
    array( 'db' => 'first_name', 'dt' => 0 ),
    array( 'db' => 'last_name',  'dt' => 1 ),
    array( 'db' => 'position',   'dt' => 2 ),
    array( 'db' => 'office',     'dt' => 3 ),
    array(
        
        'db'        => 'start_date',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
        return date( 'jS M y', strtotime($d));
        }
        ),
        
        array(
            
            'db'        => 'salary',
            'dt'        => 5,
            'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
            }
            )
         );

*/

// SQL server connection information
global $cfg_dbhost,$cfg_dbuser,$cfg_dbpassword,$cfg_database;

$sql_details = array(
    
    'user' => $cfg_dbuser,
    'pass' => $cfg_dbpassword,
    'db'   => $cfg_database,
    'host' => $cfg_dbhost
);



require( 'chm_ssp.class.php' );
  
// $output = SSP::simple( $_REQUEST, $sql_details, $table, $primaryKey, $columns );
$output = CHM_SSP::complex ( $_REQUEST, $sql_details, $table, $primaryKey, $columns, $whereResult=null, $whereAll);
    

header('Content-type: application/json');
echo json_encode($output);

?>