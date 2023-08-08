<?php

/**
* File: credentials.php
* Author: Suresh Kodoor
*
* Class holding the user login credentials.
*/

  class credentials {

	private $strUsername;
	private $strPassword;

	function setUsername($strUsername){

		$this->strUsername = $strUsername;
	}

	function getUsername(){

		return $this->strUsername;
	}
	
	function setPassword($strPassword){

		$this->strPassword = $strPassword;
	}
	
	function getPassword(){

		return $this->strPassword;
	}
	
 }
?>
