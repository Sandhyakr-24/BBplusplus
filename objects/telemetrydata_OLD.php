<?php

// Object corresponding to game_play_detail_tbl

class gameplaydetail {
	
	private $intGamePlayDetailId;  // id_game_play_detail
	private $strGamePlayMasterId;  // id_game_play
	private $strAccessToken;       // access_token
	private $strQuestionId;        // id_question
	private $strGivenAnswer;       // answer_given
	private $strPass;              // pass ('Yes' if 'answer_given' is same as  'correct_answer' for this question (in questiontbl) are same, 'No' otherwise)
	private $intAttempts;          // attempts (Number of attempts by the Child before submitting the final answer)
	private $intTime2Answer;       // time2answer (in seconds)
	private $dateTimeSubmission;   // date_time_submission (DATETIME when the answer was submitted (YYYY:MM:DD HH:MM:SS))
	private $childId;              // id_child
	private $childName;
	private $phone;
	
	function setGamePlayDetailId($intGamePlayDetailId){
	    $this->intGamePlayDetailId = $intGamePlayDetailId;
	}
	
	function getGamePlayDetailId(){
	    return $this->intGamePlayDetailId;
	}
	
	function setGamePlayMasterId($strGamePlayMasterId){
	    $this->strGamePlayMasterId = $strGamePlayMasterId;
	}
	
	function getGamePlayMasterId(){
	    return $this->strGamePlayMasterId;
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
	
	function setGivenAnswer($strGivenAnswer){
	    $this->strGivenAnswer = $strGivenAnswer;
	}
	
	function getGivenAnswer(){
	    return $this->strGivenAnswer;
	}
	
	function setPass($strPass){
	    $this->strPass = $strPass;
	}
	
	function getPass(){
	    return $this->strPass;
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
	
	function setPhone($phone){
	    $this->phone = $phone;
	}
	
	function getPhone(){
	    return $this->phone;
	}
	
}

?>