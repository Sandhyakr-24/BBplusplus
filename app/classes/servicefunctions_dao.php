<?php

class servicefunctions_dao {

    private $dbh; // dbhandler object
    
    function __construct() {
        
        $this->dbh = services_dbhandler::getInstance();         
    }
    
    
    function getChildIdByAccessToken($access_token){
 
        $additional_condition="";
        $arrResult =  $this->dbh->readRecords('device_accesstoken_tbl', 'id_child', 'access_token', $access_token, $additional_condition);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['id_child'];
    }
    
    function getChildIdByNameAndDevice($name,$deviceid) {
        
        $additional_condition = " AND deviceid = '$deviceid'";
        $arrResult =  $this->dbh->readRecords('child_tbl', 'id_child', 'child_name', $name, $additional_condition);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['id_child'];
    }
    
    function getAccessTokenForChildForDevice($name,$deviceid) {
        
        $childid = $this->getChildIdByNameAndDevice($name,$deviceid);
        if(!$childid) {
            return false;
        }

        $additional_condition = " AND deviceid = '$deviceid'";
        $arrResult =  $this->dbh->readRecords('device_accesstoken_tbl', 'access_token', 'id_child', $childid, $additional_condition);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['access_token'];
    }
    
    function checkIfAccessTokenExistsForChildForDevice($id_child, $deviceid){
	
	    $additional_condition=" and  deviceid = '$deviceid'";
	    $arrResult = $this->dbh->readRecords('device_accesstoken_tbl','access_token','id_child',$id_child,$additional_condition);
	    
	    if(count($arrResult,1) == 0) return false;
	    else return true;
	}
	
	function checkIfNameAndDeviceRegistered($childname, $deviceid) {

	    $additional_condition = " and  deviceid = '$deviceid'";
	    $arrResult = $this->dbh->readRecords('child_tbl','id_child','child_name',$childname, $additional_condition);

	    if(count($arrResult,1) == 0) return false;
	    else return true;
	}
      
	function updateAccessToken($id_child,$deviceid,$access_token,$created_datetime){
	
	    $data = array (
          'access_token' => $access_token,
	      'created_datetime' => $created_datetime
        );

        $where_condition = "id_child = $id_child and deviceid = '$deviceid'";

        $this->dbh->updateRecords('device_accesstoken_tbl',$data, $where_condition);
    
    }
      
    function saveNewAccessTokenForChildForDevice($id_child,$deviceid,$access_token,$created_datetime){
	 
	    $data =array("id_child" => $id_child,
			  "access_token" => $access_token,
			  "created_datetime" => $created_datetime,
			  "deviceid" =>$deviceid);
	 
	    $this->dbh->insertRecords('device_accesstoken_tbl ', $data);
    }
      
    function checkIfValidAccessToken($access_token){
    
	    $additional_condition="";
	    $arrResult = $this->dbh->readRecords('device_accesstoken_tbl','id','access_token',$access_token,$additional_condition);
	    
	    if(count($arrResult,1) == 0) return false;
	    else return true;
	}
	
	function updateDistrict($district,$childid) {
	    
	    $data = array (
	        'district' => $district
	    );
	    
	    $where_condition = "id_child = $childid";
	    $this->dbh->updateRecords('child_tbl',$data, $where_condition);
	}
        
   
    function insertChild($objChild) {
  
        $gradeid = $this->getGradeIdByGradeName($objChild->getGradeName());
        $languageid = $this->getLanguageIdByLanguageName($objChild->getLanguageName());
        
        if((!$gradeid) || (!$languageid))
           return false;
        
        $created_datetime = date('Y-m-d H:i:s') ;
        
        $data = array(
            
            'child_name'       =>  $objChild->getChildName(),
            'deviceid'       =>  $objChild->getDeviceId(),
            'id_grade' => $gradeid,
            'school_type' => $objChild->getSchoolTypeId(),
            'geo' => $objChild->getGeo(),
            'id_language' => $languageid,
            'organization' => $objChild->getOrg(), 
            'created_datetime' => $created_datetime,
            'avatar_pic' => $objChild->getPicFilename()
        
        );
         
        $rtn = $this->dbh->insertRecords('child_tbl', $data);
        return $rtn;
    }
    
    function updateProfile($objChild) {
        
        $gradeid = $this->getGradeIdByGradeName($objChild->getGradeName());
        $languageid = $this->getLanguageIdByLanguageName($objChild->getLanguageName());
        
        if((!$gradeid) || (!$languageid))
            return false;
        
        $data = array(

                'id_grade' => $gradeid,
                'school_type' => $objChild->getSchoolTypeId(),
                'organization' => $objChild->getOrg(),
                'id_language' => $languageid
        );
        
        $childid = $objChild->getChildId();
        $where_condition = "id_child = $childid";
        
        $rtn = $this->dbh->updateRecords('child_tbl',$data, $where_condition);
        return $rtn;
    }
    
    function getChildByChildId($childid) {
          
        $query = "SELECT C.*, G.description AS gradedescr, L.description AS langdescr 
                 FROM child_tbl C 
                 JOIN grade_tbl G ON C.id_grade = G.id_grade 
                 JOIN language_tbl L ON C.id_language = L.id_language 
                 WHERE C.id_child = ".$childid;
        
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        
        
                
        if(count($arrResult,1) == 0) return false;
        else {
            $objChild = $this->createChildObject($arrResult[0]);
            return $objChild;
        }

    }
    
    function getChildByAccessToken($access_token) {
        
        $childid = getChildIdByAccessToken($access_token);
        if(!$childid) return false;
        
        return getChildByChildId($childid);
    }
    
    function getChildByNameAndDevice($childname, $deviceid) {
        
        $query = "SELECT C.*, G.description AS gradedescr, L.description AS langdescr
                 FROM child_tbl C
                 JOIN grade_tbl G ON C.id_grade = G.id_grade
                 JOIN language_tbl L ON C.id_language = L.id_language
                 WHERE C.child_name = '$childname' AND C.deviceid = '$deviceid'";
      
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        
        
        if(count($arrResult,1) == 0) return false;
        else {
            $objChild = $this->createChildObject($arrResult[0]);
            return $objChild;
        }
    }
      
    private function createChildObject($arrData) {
          
        $objChild = new child();
          
        $objChild->setChildId($arrData['id_child']);
        $objChild->setChildName(stripslashes($arrData['child_name']));
        $objChild->setDeviceId($arrData['deviceid']);
        $objChild->setGradeId($arrData['id_grade']);
        $objChild->setGradeName($arrData['gradedescr']);
        $objChild->setSchoolTypeId($arrData['school_type']);
        $objChild->setGeo($arrData['geo']);
        $objChild->setOrg($arrData['organization']);
        $objChild->setLanguageId($arrData['id_language']);
        $objChild->setLanguageName($arrData['langdescr']);
        $objChild->setPicFileName($arrData['avatar_pic']);
        
        return $objChild;
    }
    
    function getGradeNameByGradeId($gradeid) {
        
        $condition = " AND id_grade = $gradeid";
        $arrResult = $this->dbh->readRecords('grade_tbl','description','id_grade',$gradeid);
 
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['description'];
    }
    
    function getGradeIdByGradeName($gradename) {
        
        $condition = " AND description = '$gradename'";
        $arrResult = $this->dbh->readRecords('grade_tbl','id_grade','description',$gradename);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['id_grade'];
    }
    
    function getLanguageNameByLanguageId($langid) {
        
        $condition = " AND id_language = $langid";
        $arrResult = $this->dbh->readRecords('language_tbl','description','id_language',$langid);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['description'];
    }

    function getLanguageIdByLanguageName($langname) {
        
        $condition = " AND description = '$langname'";
        $arrResult = $this->dbh->readRecords('language_tbl','id_language','description',$langname);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['id_language'];
    }
    
    function getAvatarpicFilenameByChildId($child_id){
 
        $arrResult =  $this->dbh->readRecords('child_tbl', 'avatar_pic', 'id_child', $child_id);
        
        if(count($arrResult,1) == 0) return false;
        else return $arrResult[0]['avatar_pic'];
    }
    
    function updateAvatarpicFilenameByChildId($child_id, $picfilename){
        
        if(!$child_id) return false; 

        $data = array (
            'avatar_pic' => $picfilename
        );
        
        $where_condition = "id_child = ".$child_id;

        $this->dbh->updateRecords('child_tbl',$data, $where_condition);
    }
    
    function insertGameplaydetail($objGameplaydetail) {

        $data = array(
            
            'id_child'             => $objGameplaydetail->getChildId(),
            'id_game_play'         => $objGameplaydetail->getGamePlayId(),
            'id_question'          => $objGameplaydetail->getQuestionId(),
            'pass'                 => $objGameplaydetail->getPass(),
            'attempts'             => $objGameplaydetail->getAttempts(),
            'date_time_submission' => $objGameplaydetail->getDateTimeSubmission(),
            'time2answer'          => $objGameplaydetail->getTime2Answer()
        );
        
        $rtn = $this->dbh->insertRecords('game_play_detail_tbl', $data);
        return $rtn;
    }
    
    function insertCHMGameplaydetail($objGameplaydetail) {
        
        $data = array(
            
            'id_child'             => $objGameplaydetail->getChildId(),
            'id_game_play'         => $objGameplaydetail->getGamePlayId(),
            'id_question'          => $objGameplaydetail->getQuestionId(),
            'pass'                 => $objGameplaydetail->getPass(),
            'date_time_submission' => $objGameplaydetail->getDateTimeSubmission(),
            'time2answer'          => $objGameplaydetail->getTime2Answer()
        );
        
        $rtn = $this->dbh->insertRecords('chm_game_play_detail_tbl', $data);
        return $rtn;
    }
    
    function getGameplaydetailByGameplaydetailId($gamedetailid) {
        
        $query = "SELECT T.*, C.child_name AS childname, C.deviceid AS deviceid  
                 FROM [game_play_detail_tbl] T
                 JOIN child_tbl C ON T.id_child = C.id_child
                 WHERE T.id_game_play_detail = '$gamedetailid'";
        
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        
        if(count($arrResult,1) == 0) return false;
        else {
            $objGameplaydetail = $this->createGameplaydetailObject($arrResult[0]);
            return $objGameplaydetail;
        }
    }
    
    private function createGameplaydetailObject($arrData) {
        
        $objGameplaydetail = new gameplaydetail();
        
        $objGameplaydetail->setGamePlayDetailId($arrData['id_game_play_detail']);
        $objGameplaydetail->setGamePlayId($arrData['id_game_play']);
        $objGameplaydetail->setChildId($arrData['id_child']);
        $objGameplaydetail->setChildName($arrData['childname']);
        $objGameplaydetail->setDeviceId($arrData['deviceid']);
        $objGameplaydetail->setQuestionId($arrData['id_question']);
        $objGameplaydetail->setPass($arrData['pass']);
        $objGameplaydetail->setAttempts($arrData['attempts']);
        $objGameplaydetail->setTime2Answer($arrData['time2answer']);
        $objGameplaydetail->setdateTimeSubmission($arrData['date_time_submission']);
        
        return $objGameplaydetail;
    }
    
    function insertGameplay($objGameplay) {
        
        // save the childid corresponding to the access_token 
        // (the access_token may get updated in the accesstoken table if the Child logs in again from the same device later at some point in time and hence saving 'access_token' will not work) 
        // $childid = getChildIdByAccessToken($objGameplay->getAccessToken());
        // if(!$childid) return false;

        $data = array(
            
            'id_game_play'         => $objGameplay->getGamePlayId(),
            'id_child'             => $objGameplay->getChildId(),
            'id_game'              => $objGameplay->getGameId(),
            'start_time'           => $objGameplay->getStartTime()
        );
        
        $rtn = $this->dbh->insertRecords('game_play_tbl', $data);
        return $rtn;
    }
    
    function insertCHMGameplay($objGameplay) {
      
        $data = array(
            
            'id_game_play'         => $objGameplay->getGamePlayId(),
            'id_child'             => $objGameplay->getChildId(),
            'id_game'              => $objGameplay->getGameId(),
            'start_time'           => $objGameplay->getStartTime(),
            'hints'                => $objGameplay->getHints()
        );
        
        $rtn = $this->dbh->insertRecords('chm_game_play_tbl', $data);
        return $rtn;
    }
    
    function getGameplayByGameplayId($gameplayid) {
        
        $query = "SELECT T.*, C.child_name AS childname, C.deviceid AS deviceid
                 FROM [game_play_tbl] T
                 JOIN child_tbl C ON T.id_child = C.id_child
                 WHERE T.id_game_play = '$gameplayid'";
        
        $arrResult = $this->dbh->readRecordsWithQuery($query);
        
        if(count($arrResult,1) == 0) return false;
        else {
            $objGameplay = $this->createGameplayObject($arrResult[0]);
            return $objGameplay;
        }
    }
    
    private function createGameplayObject($arrData) {
        
        $objGameplay = new gameplay();
        
   
        $objGameplay->setIdgp($arrData['idgp']);
        $objGameplay->setGamePlayId($arrData['id_game_play']);
        $objGameplay->setGameId($arrData['id_game']);
        $objGameplay->setChildId($arrData['id_child']);
        $objGameplay->setChildName($arrData['childname']);
        $objGameplay->setDeviceId($arrData['deviceid']);
        $objGameplay->setStartTime($arrData['start_time']);
         
        return $objGameplay;
    }
    
    function insertCHMwalletscore($childid, $score, $datetime_lastupdated) {
        
        $data = array(
            
            'id_child'     => $childid,
            'score'      => $score,
            'datetime_lastupdated'  => $datetime_lastupdated
        );
        
        $rtn = $this->dbh->insertRecords('chm_walletscore_tbl', $data);
        return $rtn;
    }
    
    function updateCHMwalletscore($childid, $score, $datetime_lastupdated){
        
        $data = array (
            'id_child'     => $childid,
            'score'      => $score,
            'datetime_lastupdated'  => $datetime_lastupdated
        );
        
        $where_condition = "id_child = ".$childid;
        
        $rtn = $this->dbh->updateRecords('chm_walletscore_tbl',$data, $where_condition);
        
        return $rtn;
    }
    
    function getCHMwalletscore($childid) {

        $query = "SELECT score, datetime_lastupdated 
                 FROM chm_walletscore_tbl
                 WHERE id_child = '$childid'";
 

        $arrResult = $this->dbh->readRecordsWithQuery($query);

        if(count($arrResult,1) == 0) {
            return false;
        }
        else {
            return $arrResult[0];
        }
       
    }
    
    function getCHMgamemasterdata() {
        
        $query = "SELECT C.*, G.description AS gradedescr
                 FROM chm_game_master_tbl C
                 JOIN grade_tbl G ON C.id_grade = G.id_grade";

        $arrResult = $this->dbh->readRecordsWithQuery($query);
        
        if(count($arrResult,1) == 0) {
            return false;
        }
        else {
            return $arrResult;
        }
    }

}  // end of the Class 
?>