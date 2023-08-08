<?php

 class user {
	
	private $intUserId;        
	private $strEmail;  //emai_id should be unique. This is the login Id for the user.
	private $strFirstName;
	private $strLastName;
	private $strPassword;
	private $strPhoneNumber;
 	private $strOrganization;
	private $strCreatedDatetime;   
	private $strPicFileName;
	

	function setUserId($intUserId){
	
	    $this->intUserId = $intUserId;
	}
	
	function getUserId(){
	
	    return $this->intUserId;
	}
	

	function setEmail( $strEmail ) {
	
	    $this->strEmail = $strEmail;
	}
	
	function getEmail() {
	
	    return $this->strEmail;
	}
	
	function setPassword( $strPassword ) {
	    
	    $this->strPassword = $strPassword;
	}
	
	function getPassword() {
	    
	    return $this->strPassword;
	}
	
	function setFirstName( $strFirstName ) {
	
	    $this->strFirstName = stripslashes($strFirstName);
	}
	
	function getFirstName() {
	
	    return $this->strFirstName;
	}
	
	
	function setLastName( $strLastName ) {
	
	    $this->strLastName = stripslashes($strLastName);
	}
	
	function getLastName() {
	
	    return $this->strLastName;
	}
	
	
	function setPhoneNumber($strPhoneNumber){	
	    
	    $this->strPhoneNumber = $strPhoneNumber;
	}

	function getPhoneNumber()	{	
	    
	    return $this->strPhoneNumber;
	}
	

	function setOrganization($strOrganization) {
	    
	    $this->strOrganization = $strOrganization;
	}
	
	function getOrganization() {
	    
	    return $this->strOrganization ;
	}
	
	
	function setCreatedDatetime($strCreatedDatetime) {
	
	    $this->strCreatedDatetime =  $strCreatedDatetime;
	}
	
	function getCreatedDatetime() {
	
	    return $this->strCreatedDatetime;
	}
	
	function setPictureFileName($strPicFileName) {
	    
	    $this->strPicFileName = $strPicFileName;
	}
	
	function getPictureFileName() {
	    
	    return $this->strPicFileName;
	}

 }
?>