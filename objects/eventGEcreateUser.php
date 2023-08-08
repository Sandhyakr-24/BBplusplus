<?php
namespace objects;

/**
 * File: eventCommonDS.php
 * Author: Suresh Kodoor
 *
 * Common Event Data Structure
 */

class eventGEcreateUser
{
    
    private $loc;
    private $uid;
    
    function setloc($loc) {
        $this->loc = $loc;
    }
    
    function getloc() {
        return $this->loc;
    }
    
    function setuid($uid) {
        $this->uid = $uid;
    }
    
    function getuid() {
        return $this->uid;
    }
    
}

