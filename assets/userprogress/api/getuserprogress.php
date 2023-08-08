<?php
/**
 * Service API:  getuserprogress
 * File name: getuserprogress.php
 * Author: Harshith D S
 * 
 * JSON Payload:
 * {
 * "name":"",
 * "deviceid":"",
 * }
 *    
 * JSON Response:
 * {
 * "status":"failed/success",
 * "description":"reason for failure, if status is 'failed'",
 * "data......"
 * }
 * 
 */
    

    session_start();

    error_reporting(0);
    
    $appbasedirorg = dirname(__FILE__);
    $appbasedir = substr($appbasedirorg,0,-4); // remove the directory name api
    $_SESSION['ABSAPP_BASE_DIR'] = $appbasedir;
    
    $appconfigfile = $appbasedir."/config/appconfig.php";
    $_SESSION['ABSAPP_CONFIG_FILE'] = $appconfigfile;
    
    $dbconfigfile = $appbasedir."/config/dbconfig.php";
    $_SESSION['ABSAPP_DB_CONFIG_FILE'] = $dbconfigfile;
    
    $querystr = $_SERVER['QUERY_STRING'];
    
    $hosturl = "http://".$_SERVER['HTTP_HOST'];
    $requesturi = $_SERVER['REQUEST_URI'];
    $lenuri = strripos($requesturi,"/",0);  // find the position of last occurance of '/'
    $appurl = substr($requesturi,0,$lenuri-4); // 4 chars removed as the uri will contain 'api' directory also
    
    $appbaseurl = $hosturl.$appurl."/";
    $_SESSION['ABSAPP_BASE_URL'] = $appbaseurl;
    
    require_once($_SESSION['ABSAPP_BASE_DIR']."/servicefunctions/servicefunctions.php");

    //$jsonstring = $_GET['json'];
    $jsonstring = file_get_contents("php://input");
    $data = json_decode($jsonstring); 
    
    $childname = $data->{'name'};
    $deviceid = $data->{'deviceid'};
    
    if($childname && $deviceid){
    
        $rtn = checkIfNameAndDeviceRegistered($childname, $deviceid);


        
       if(!$rtn) {
           $responsedata = array(
               'status' => "failed",
               'description' => "No Child is registered with the given name and deviceid ($childname, $deviceid)."
           );
           $em = new exceptionMgr(" ");
           $em->logInfo("getchild: Error: No Child is registered with the given name and deviceid ($childname, $deviceid).");
       }
       else {


            $objChild = getChildByNameAndDevice($childname, $deviceid);

           if(!$objChild){
               
               $responsedata = array(
                   'status' => "failed",
                   'description' => "Failed to retrieve the Child details for the given name and deviceid ($childname, $deviceid)."
               );
               $em = new exceptionMgr(" ");
               $em->logInfo("getchild: Error: Failed to retrieve the Child details for the given name and deviceid ($childname, $deviceid).");
           }
           else {
               
               $objChild_userprogress = getChildUserProgress($objChild->getChildId());


               if(!$objChild_userprogress){
                   
                   $responsedata = array(
                       'status' => "failed",
                       'description' => "Failed to retrieve the Child user progress details for the given child"
                   );
                   $em = new exceptionMgr(" ");
                   $em->logInfo("getchild: Error: Failed to retrieve the Child user progress details for the given child");
               }
               else {
                   
                 $responsedata = array(
                       'status' => "success",
                       'description' => "Child details have been successfully retrieved.",
                       'PMST' => $objChild_userprogress->getPMST(),
                       'CMST' => $objChild_userprogress->getCMST(),

                       'PMNST' => $objChild_userprogress->getPMNST(),
                       'CMNSST' => $objChild_userprogress->getCMNSST(),

                       'PMGMT' => $objChild_userprogress->getPMGMT(),
                       'CMMST' => $objChild_userprogress->getCMMST(),

                       'PALGT' => $objChild_userprogress->getPALGT(),
                       'CMNOST' => $objChild_userprogress->getCMNOST(),

                       'PNS' => $objChild_userprogress->getPNS(),
                        'PALG' => $objChild_userprogress->getPALG(),
                        'PGM' => $objChild_userprogress->getPGM(),
                        'PNSN' => $objChild_userprogress->getPNSN(),
                        'PNSI' => $objChild_userprogress->getPNSI(),
                        'PNSF' => $objChild_userprogress->getPNSF(),
                        'PNSD' => $objChild_userprogress->getPNSD(),
                        'PNSR' => $objChild_userprogress->getPNSR(),
                        'PALGV' => $objChild_userprogress->getPALGV(),
                        'PGMS' => $objChild_userprogress->getPGMS(),
                        'PGMM' => $objChild_userprogress->getPGMM(),


                        // 'PMW' => $objChild_userprogress->getPMW(),
                        // 'PMT' => $objChild_userprogress->getPMT(),
                        // 'PMV' => $objChild_userprogress->getPMV(),
                        // 'PNOA' => $objChild_userprogress->getPNOA(),
                        // 'PNOS' => $objChild_userprogress->getPNOS(),
                        // 'PNOM' => $objChild_userprogress->getPNOM(),
                        // 'PNOD' => $objChild_userprogress->getPNOD(),
                        // 'PNOLD' => $objChild_userprogress->getPNOLD(),
                        // 'PNOLM' => $objChild_userprogress->getPNOLM(),



                        'CNS' => $objChild_userprogress->getCNS(),
                        'CNO' => $objChild_userprogress->getCNO(),
                        'CM' => $objChild_userprogress->getCM(),
                        'CNSN' => $objChild_userprogress->getCNSN(),
                        'CNSF' => $objChild_userprogress->getCNSF(),
                        'CNSS' => $objChild_userprogress->getCNSS(),
                        'CNSC' => $objChild_userprogress->getCNSC(),
                        'CNSPV' => $objChild_userprogress->getCNSPV(),
                        'CML' => $objChild_userprogress->getCML(),
                        'CMW' => $objChild_userprogress->getCMW(),
                        'CMTi' => $objChild_userprogress->getCMTi(),
                        'CMV' => $objChild_userprogress->getCMV(),
                        'CNOA' => $objChild_userprogress->getCNOA(),
                        'CNOS' => $objChild_userprogress->getCNOS(),
                        'CNOM' => $objChild_userprogress->getCNOM(),
                        'CNOD' => $objChild_userprogress->getCNOD(),

                        'CNSP' => $objChild_userprogress->getCNSP(),
                        'CNOP' => $objChild_userprogress->getCNOP(),
                        'CMP' => $objChild_userprogress->getCMP(),
                        'CNSNP' => $objChild_userprogress->getCNSNP(),
                        'CNSFP' => $objChild_userprogress->getCNSFP(),
                        'CNSSP' => $objChild_userprogress->getCNSSP(),
                        'CNSCP' => $objChild_userprogress->getCNSCP(),
                        'CNSPVP' => $objChild_userprogress->getCNSPVP(),
                        'CMLP' => $objChild_userprogress->getCMLP(),
                        'CMWP' => $objChild_userprogress->getCMWP(),
                        'CMTP' => $objChild_userprogress->getCMTTP(),
                        'CMVP' => $objChild_userprogress->getCMVP(),
                        'CNOAP' => $objChild_userprogress->getCNOAP(),
                        'CNOSP' => $objChild_userprogress->getCNOSP(),
                        'CNOMP' => $objChild_userprogress->getCNOMP(),
                        'CNODP' => $objChild_userprogress->getCNODP(),

                        'CNSFF' => $objChild_userprogress->getCNSFF(),
                        'CNOF' => $objChild_userprogress->getCNOF(),
                        'CMF' => $objChild_userprogress->getCMF(),
                        'CNSNF' => $objChild_userprogress->getCNSNF(),
                        'CNSFFF' => $objChild_userprogress->getCNSFFF(),
                        'CNSSF' => $objChild_userprogress->getCNSSF(),
                        'CNSCF' => $objChild_userprogress->getCNSCF(),
                        'CNSPVF' => $objChild_userprogress->getCNSPVF(),
                        'CMLF' => $objChild_userprogress->getCMLF(),
                        'CMWF' => $objChild_userprogress->getCMWF(),
                        'CMTF' => $objChild_userprogress->getCMTTF(),
                        'CMVF' => $objChild_userprogress->getCMVF(),
                        'CNOAF' => $objChild_userprogress->getCNOAF(),
                        'CNOSF' => $objChild_userprogress->getCNOSF(),
                        'CNOMF' => $objChild_userprogress->getCNOMF(),
                        'CNODF' => $objChild_userprogress->getCNODF(),

                        'CNST' => $objChild_userprogress->getCNST(),
                        'CNOT' => $objChild_userprogress->getCNOT(),
                        'CMT' => $objChild_userprogress->getCMT(),
                        'CNSNT' => $objChild_userprogress->getCNSNT(),
                        'CNSFT' => $objChild_userprogress->getCNSFT(),
                        'CNSST' => $objChild_userprogress->getCNSST(),
                        'CNSCT' => $objChild_userprogress->getCNSCT(),
                        'CNSPVT' => $objChild_userprogress->getCNSPVT(),
                        'CMLT' => $objChild_userprogress->getCMLT(),
                        'CMWT' => $objChild_userprogress->getCMWT(),
                        'CMTT' => $objChild_userprogress->getCMTT(),
                        'CMVT' => $objChild_userprogress->getCMVT(),
                        'CNOAT' => $objChild_userprogress->getCNOAT(),
                        'CNOST' => $objChild_userprogress->getCNOST(),
                        'CNOMT' => $objChild_userprogress->getCNOMT(),
                        'CNODT' => $objChild_userprogress->getCNODT(),


                        'CNSH' => $objChild_userprogress->getCNSH(),
                        'CNOH' => $objChild_userprogress->getCNOH(),
                        'CMH' => $objChild_userprogress->getCMH(),
                        'CNSNH' => $objChild_userprogress->getCNSNH(),
                        'CNSFH' => $objChild_userprogress->getCNSFH(),
                        'CNSSH' => $objChild_userprogress->getCNSSH(),
                        'CNSCH' => $objChild_userprogress->getCNSCH(),
                        'CNSPVH' => $objChild_userprogress->getCNSPVH(),
                        'CMLH' => $objChild_userprogress->getCMLH(),
                        'CMWH' => $objChild_userprogress->getCMWH(),
                        'CMTH' => $objChild_userprogress->getCMTH(),
                        'CMVH' => $objChild_userprogress->getCMVH(),
                        'CNOAH' => $objChild_userprogress->getCNOAH(),
                        'CNOSH' => $objChild_userprogress->getCNOSH(),
                        'CNOMH' => $objChild_userprogress->getCNOMH(),
                        'CNODH' => $objChild_userprogress->getCNODH()
                   );
               }
           }


        }
    }
    else {
        
        $responsedata = array(
            'status' => "failed",
            'description' => "Input parameters missing."
        );
        $em = new exceptionMgr(" ");
        $em->logInfo("getuserprogress: Error: Input parameters missing.");
    }
    
    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *');
    echo json_encode($responsedata);
    
?>    