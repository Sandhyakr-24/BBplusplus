<?php
    session_start();
    
  class app_user_dao {
        
     private $dbh; // dbhandler object
     private $app_dao;

     function __construct() {
	  
           $this->dbh = emrp_dbhandler::getInstance();
           $this->app_dao = new app_dao();
     }
      
     function insertUser($objUser) {
	
         
         $created_datetime = date('Y-m-d H:i:s') ;
         
         $data = array(
             
             'first_name'       =>  $objUser->getFirstName(),
             'last_name'        =>  $objUser->getLastName(),
             'phone_number'     =>  $objUser->getPhone(),
             'email_id'          =>  $objUser->getEmailId(),
             'password'         =>  $objUser->getPassword(),
             'organization'     =>  $objUser->getOrg(),
             'created_datetime' =>  $objUser->getCreatedDatetime(),
             'user_pic'         =>  $objUser->getPicFilename()
             
         );
         
         $rtn = $this->dbh->insertRecords('user_tbl', $data);
         return $rtn;
    }


	function updateUser($objUser) {
  
	    $phone_number = $objUser->getPhone();

	    $changes = array(
		
	        'first_name'       =>  $objUser->getFirstName(),
	        'last_name'        =>  $objUser->getLastName(),
	        'phone_number'     =>  $objUser->getPhone(),
	        'email_id'          =>  $objUser->getEmailId(),
	        'password'         =>  $objUser->getPassword(),
	        'organization'     =>  $objUser->getOrg(),
	        'created_datetime' =>  $objUser->getCreatedDatetime(),
	        'user_pic'         =>  $objUser->getPicFilename()
   
	    );
	   
    
	    $condition = " user_id = '".$objUser->getUserId()."'";
	    
	    $this->dbh->updateRecords('user_tbl', $changes,$condition);
	}
	
	
	function getUserByUserId($user_id) {
	  
	      return($this->getUser('user_id',$user_id));
	}
	 
  
	function getUserIdByEmailId($email_id) {
    
	    $additional_condition = "";
	    $arrResult =  $this->dbh->readRecords('user_tbl', 'user_id', 'email_id', $email_id, $additional_condition);
	    return $arrResult[0]['user_id'];
    }
    
	function getUserFullNameByUserId($user_id) {
	    
	    $array= array('firstname','lastname');
	    $where_condition= "user_id='".$user_id."'";
	    $arrResult =$this->dbh->readRecordsMultipleFields('user_tbl',$array,$where_condition);
	    return $arrResult;
	}
	
      
    function getPasswordByUserId($user_id) {
        
	    $arrResult = $this->dbh->readRecords('user_tbl', 'password', 'user_id', $user_id);
	    return $arrResult[0]['password'];
    }
   
	function getUserByEmailId($email_id, $library_id) {
	   
	     $condition = " AND email_id = $email_id";
	     $arrResult = $this->dbh->readRecordsAllFields('user_tbl',$condition);

         $objUser = $this->createUserObject($arrResult[0]);
         return $objUser;
    }
      
    /* Get User information from user_tbl
     *
     * fieldname - name of the field in the user_tbl
     * value of the field for which search is to be performed
     */
     private function getUser($fieldname, $fieldvalue) {
        
         $fvalue = ( is_numeric( $fieldvalue ) && ( intval( $fieldvalue ) == $fieldvalue ) ) ? $fieldvalue : "'$fieldvalue'";
         $condition = "$fieldname = $fvalue";
         
	     $arrResult = $this->dbh->readRecordsAllFields('user_tbl',$condition);
         $objUser = $this->createUserObject($arrResult[0]);
         return $objUser;
       
    }
  
	  
	function getUserEmailIdByUserId($user_id){
                
         $arrResult = $this->dbh->readRecords('user_tbl', 'email_id','user_id',$user_id);		
         return $arrResult[0]['email_id'];  
	}
	  
	
    function getAllUserDetails(){
        
         $condition = "  order by firstname ";
	     $arrResult = $this->dbh->readRecordsAllFields('user_tbl',$condition);
	     $objUser = $this->createUserObject($arrResult[0]);
	     return $objUser;
    }
    
      
    function getUserDetailsBySrchText($srchText){
	
         $query = "SELECT firstname,lastname,email_id,user_id,phone_number
	            FROM user_tbl WHERE ( firstname LIKE '%".$srchText."%' or lastname LIKE '%".$srchText."%' ) order by firstname ";
		 
	 
	     $arrResult = $this->dbh->readRecordsWithQuery($query);
         return $arrResult;
    }
    
    function getUserDetailsByAlphabet($alphabet){
        
         $query = "SELECT firstname,lastname,email_id,user_id,phone_number
	           FROM user_tbl
		       WHERE
		       firstname LIKE '".$alphabet."%'
			   order by firstname 
		       ";
	     $arrResult = $this->dbh->readRecordsWithQuery($query);
         return $arrResult;
    }
    
  
    function updatePassword($user_id, $password) {

        $data = array (
          'password' => $password
        );

        $where_condition = "user_id = '$user_id'";

        $this->dbh->updateRecords('user_tbl',$data, $where_condition);
    }
    
    public function createUserObject($arrData) {

        $objUser = new user();
        
        $objUser->setUserId($arrData['user_id']);
        $objUser->setFirstName(stripslashes($arrData['firstname']));
        $objUser->setLastName(stripslashes($arrData['lastname']));
        $objUser->setPhoneNumber($arrData['phone_number']);
        $objUser->setEmailId($arrData['email_id']);
        $objUser->setPassword($arrData['password']);
        $objUser->setOrganization($arrData['organization']);
        $objUser->setCreatedDatetime($arrData['created_datetime']);
        $objUser->setPicFilename($arrData['picture_filename']);
	
        return $objUser;
    
 	}
	
 }

?>