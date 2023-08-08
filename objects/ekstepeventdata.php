<?php

class ekstepeventdata {
	
    private $intEkStepEventDataId;
	private $strGamePlayId;
	private $strQuestionId;
    private $strEkStepEventId;  // e.g  OE_INTERACT
	private $dateTimeEvent;     // DATETIME when the event occured (YYYY:MM:DD HH:MM:SS)
	private $edata;             // An object holding the JSON array
	private $childId;           // id_child
	private $childName;         // Not part of the ekstepevent_interact_tbl_tbl
	private $phone;             // Not part of the ekstepevent_interact_tbl
	private $deviceid;          // Not part of the ekstepevent_interact_tbl
	private $strAccessToken;    // access_token. Not part of the ekstepevent_interact_tbl
	
	function setEkStepEventDataId($intEkStepEventDataId){
	    $this->intEkStepEventDataId = $intEkStepEventDataId;
	}
	
	function getEkStepEventDataId(){
	    return $this->intEkStepEventDataId;
	}
	
	function setGamePlayId($strGamePlayId){
	    $this->strGamePlayId = $strGamePlayId;
	}
	
	function getGamePlayId(){
	    return $this->strGamePlayId;
	}
	
	function setAccessToken($strAccessToken){
	    $this->strAccessToken = $strAccessToken;
	}
	
	function getAccessToken(){
	    return $this->strAccessToken;
	}
	
	function setQuestionId($strQuestionId){
	    $this->strQuestionId = $strQuestionId;
	}
	
	function getQuestionId(){
	    return $this->strQuestionId;
	}
	
	function setEkstepEventId($strEkStepEventId){
	    $this->strEkStepEventId = $strEkStepEventId;
	}
	
	function getEkstepEventId(){
	    return $this->strEkStepEventId;
	}
	
	
	function setdateTimeEvent($dateTimeEvent){
	    $this->dateTimeEvent = $dateTimeEvent;
	}
	
	function getdateTimeEvent(){
	    return $this->dateTimeEvent;
	}
	
	function setedata($edata){
	    $this->edata = $edata;
	}
	
	function getedata(){
	    return $this->edata;
	}
	
	function setChildId($childId){
	    $this->childId = $childId;
	}
	
	function getChildId(){
	    return $this->childId;
	}
	
	function setChildName($childName){
	    $this->childName = $childName;
	}
	
	function getChildName(){
	    return $this->childName;
	}
	
	function setDeviceId($deviceid){
	    $this->deviceid = $deviceid;
	}
	
	function getDeviceId(){
	    return $this->deviceid;
	}
	
	function setPhone($phone){
	    $this->phone = $phone;
	}
	
	function getPhone(){
	    return $this->phone;
	}
}

?>