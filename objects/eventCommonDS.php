<?php
namespace objects;

/**
 * File: eventCommonDS.php
 * Author: Suresh Kodoor
 *
 * Common Event Data Structure
 */
class eventCommonDS
{
    
    private $eid; // unique event ID
    private $ts;  // timestamp of event capture in YYYY-MM-DDThh:mm:ss+/-nn:nn 
    private $ets; // epoch timestamp of event capture in epoch format (time in milli-seconds. For ex: 1442816723)
    private $ver; // version of the event data structure, currently "2.1"
    private $mid; // Unique message id. Ideally should be a consistent hash of the event or checksum
    private $channel; // Channel ID
    private $pdata = array();   // Producer information. Generally the App which is creating the event
                                // "id": "", Producer ID. For ex: For ekstep it would be "portal" or "genie"
                                // "ver": "", version of the App
    private $gdata = array();   // data about the game that generated this event
                                // "id": "", unique id assigned to that game
                                // "ver": "" version number of the game
    private $cdata = array();   //correlation data
                                // "type":"" Used to indicate action that is being correlated
                                // "id": "" The correlation ID value
    private $sid; // user session ID (created whenever a user signs in), empty when no user is signed in
    private $uid; // uuid of the user account, empty when no user is signed in
    private $did; // uuid of the device, created during app installation
    private $edata = array();   // event specific data structure
                                // "eks": {} data structure specific to event ID (see later sections for details)
    private $etags = array(); 
                                // "app": [""], Genie tags
                                // "partner": [""], Partner tags
                                // "dims": [""] Encrypted dimension tags passed by respective channels
    
    
    function seteid($eid) {
        $this->eid = $eid;
    }
    
    function geteid() {
        return $this->eid;
    }
    
    function setts($ts) {
        $this->ts = $ts;
    }
    
    function getts() {
        return $this->ts;
    }
    
    function setets($ets) {
        $this->ets = $ets;
    }
    
    function getets() {
        return $this->ets;
    }
    
    
    
    
    
    
    function setedata($edata) {
        $this->edata = $edata;
    }
    
    function getedata() {
        return $this->edata;
    }
}

