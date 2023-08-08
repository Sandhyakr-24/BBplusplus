<?php

// Object corresponding to game_play_detail_tbl

class gameplaydetail {
	
	private $intGamePlayDetailId;  // id_game_play_detail
	private $strGamePlayId;        // id_game_play
	private $strQuestionId;        // id_question
	private $intAttempts;          // attempts (Number of attempts by the Child before submitting the final answer)
	private $intTime2Answer;       // time2answer (in seconds)
	private $dateTimeSubmission;   // date_time_submission (DATETIME when the answer was submitted (YYYY:MM:DD HH:MM:SS))
	private $childId;              // id_child
	private $strPass;              // 'Yes'/'No'. If the child has given correct answer for this question or not (The 'pass' status will be sent by the game)
	private $childName;            // Not part of the game_play_detail_tbl
	private $deviceid;             // Not part of the game_play_detail_tbl
	private $strAccessToken;       // access_token. Not part of the game_play_detail_tbl
	
	
	function setGamePlayDetailId($intGamePlayDetailId){
	    $this->intGamePlayDetailId = $intGamePlayDetailId;
	}
	
	function getGamePlayDetailId(){
	    return $this->intGamePlayDetailId;
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
	
	function setQuestionId($intQuestionId){
	    $this->intQuestionId = $intQuestionId;
	}
	
	function getQuestionId(){
	    return $this->intQuestionId;
	}
	
	function setAttempts($intAttempts){
	    $this->intAttempts = $intAttempts;
	}
	
	function getAttempts(){
	    return $this->intAttempts;
	}
	
	function setTime2Answer($intTime2Answer){
	    $this->intTime2Answer = $intTime2Answer;
	}
	
	function getTime2Answer(){
	    return $this->intTime2Answer;
	}
	
	function setdateTimeSubmission($dateTimeSubmission){
	    $this->dateTimeSubmission = $dateTimeSubmission;
	}
	
	function getdateTimeSubmission(){
	    return $this->dateTimeSubmission;
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
	
	function setPass($strPass){
	    $this->strPass = $strPass;
	}
	
	function getPass(){
	    return $this->strPass;
	}
	
}

?>