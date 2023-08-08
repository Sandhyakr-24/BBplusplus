<?php

class child {
	
	private $intChildId;
	private $strChildName;	
	private $strDeviceid;
	private $intGradeId;
	private $strGradeName;
	private $intSchoolTypeId; // 0 - govt, 1 - pvt
	private $strGeo;
	private $intLanguageId;
	private $strLanguageName;
	private $strPicFileName;
	private $strOrganization; 
	
	
	function setChildId($intChildId){
	    $this->intChildId = $intChildId;
	}
	
	function getChildId(){
	    return $this->intChildId;
	}
	
	function setChildName($strChildName) {
	    $this->strChildName = $strChildName ;
	}
	
	function getChildName() {
	    return $this->strChildName;
	}
	
	function setDeviceId($strdeviceid) {
	    $this->strDeviceid = $strdeviceid ;
	}
	
	function getDeviceId() {
	    return $this->strDeviceid;
	}
	
	
	function setGradeId($intGradeId) {
	    $this->intGradeId = $intGradeId;
	}
	
	function getGradeId()	{
	    return $this->intGradeId;
	}
	
	function setGradeName($strGradeName) {
	    $this->strGradeName = $strGradeName;
	}
	
	function getGradeName()	{
	    return $this->strGradeName;
	}
	
	function setSchoolTypeId($intSchoolTypeId) {
	    $this->intSchoolTypeId = $intSchoolTypeId;
	}
	
	function getSchoolTypeId()	{
	    return $this->intSchoolTypeId;
	}
	
	function setGeo($strGeo) {
	    $this->strGeo = $strGeo;
	}
	
	function getGeo()	{
	    return $this->strGeo;
	}
	
	function setLanguageId($intLanguageId){
	    $this->intLanguageId = $intLanguageId;
	}
	
	function getLanguageId(){
	    return $this->intLanguageId;
	}
	
	function setLanguageName($strLanguageName){
	    $this->strLanguageName = $strLanguageName;
	}
	
	function getLanguageName(){
	    return $this->strLanguageName;
	}
	
	function setPicFileName($strPicFileName){
	    
	    $this->strPicFileName = $strPicFileName;
	}
	
	function getPicFileName(){
	    return $this->strPicFileName;
	}
	
	function setOrg($strOrganization){
	    $this->strOrganization = $strOrganization;
	}
	
	function getOrg(){
	    return $this->strOrganization;
	}	
}

?>