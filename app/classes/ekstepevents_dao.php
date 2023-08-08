<?php

class ekstepevents_dao {

    private $dbh; // dbhandler object
    private $rtnmsg = '';
    
    function __construct() {
        
        $this->dbh = services_dbhandler::getInstance();         
    }
    
    
    function insertEkStepEventData($objEkStepEventData) {
        
        $rtnflag = true;
        $logmsg  = '';
        
       
        $ekstep_eventid = $objEkStepEventData->getEkStepEventId();
        
        switch($ekstep_eventid) {
            
            case 'OE_INTERACT':
                
               
                $edata = $objEkStepEventData->getedata();
                
                $eks = $edata->{'eks'};
                
                // eks parameters for the OE_INTERACT event
                $type    = $eks->{'type'};
                $resourceid = $eks->{'id'};    // Resource Id (e.g BUTTON, SCREEN, PAGE etc) on which Interaction happened
                
                $data = array(
                    
                    'id_child'             => $objEkStepEventData->getChildId(),
                    'id_game_play'         => $objEkStepEventData->getGamePlayId(),
                    'id_question'          => $objEkStepEventData->getQuestionId(),
                    'ekstep_eventid'       => $objEkStepEventData->getEkStepEventId(),
                    'date_time_event'      => $objEkStepEventData->getDateTimeEvent(),
                    
                    'event_type'    => $type,
                    'res_id'        => $resourceid
                    
                );
                
                
                $rtnflag = $this->dbh->insertRecords('ekstepevent_interact_tbl', $data);
                break;
                
            default:
                $rtnflag = false;
                $logmsg  = "This event ($ekstep_eventid) is not supported.";
                break;
        }
        
        if(!$rtnflag) {
            
            $exeptionmgr = new exceptionMgr($logmsg);
            $exeptionmgr->handleError();
        }
        
        return $rtnflag;
    }
}  // end of the Class 
?>