<?php

/**
* File: dbhandler.php
* This file has all the database handler functions
*/
//require_once(dirname(__FILE__)."/../config/dbconfig.php");
require_once($_SESSION['EMRP_DB_CONFIG_FILE']);

class emrp_dbhandler {

    private  $_server;
    private  $_username;
    private  $_password;
    private  $_database;
    
    private static $connected = false;
    private static $link;
    private static $result;
    private static $affected;
    private static $numRows;
    private static $error;
    private static $timetaken;
    private static $lastInsertedId;
    private static $mulAffected = array();
    private static $mulNumRows = array();
    private static $mulLastInsertedId = array();
    
    private static $instance;
    private $em;
    
    private function __construct($server, $username, $password, $database) {

        $this->_server   = $server;
        $this->_username = $username;
        $this->_password = $password;
        $this->_database = $database;
        
        $this->em = new exceptionMgr(" ");     
    }
    
    private function connect() {
    

        if(emrp_dbhandler::$connected == false) {
            try {
                emrp_dbhandler::$link = @mysqli_connect($this->_server, $this->_username, $this->_password, $this->_database);
			   
                if (!is_object(emrp_dbhandler::$link)) {
                    self::$error = 'Error Code : ' .mysqli_connect_errno() . ' Error : ' . mysqli_connect_error();
                    throw new exceptionMgr(self::$error);
                } 
                else {
                    emrp_dbhandler::$connected = true;
                }
            }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
			catch(Exception $e) {
				try {
                  throw new exceptionMgr(self::$error);
				}
                catch (exceptionMgr $e) {
                  $e->handleError();
                }
			}
        }
    }
   
     public static function getInstance()  {
     
	    global $cfg_dbhost,$cfg_dbuser,$cfg_dbpassword,$cfg_database;
	

        if (!emrp_dbhandler::$instance instanceof self) {
            emrp_dbhandler::$instance = new self($cfg_dbhost,$cfg_dbuser,$cfg_dbpassword,$cfg_database);
        }
        return emrp_dbhandler::$instance;
     }
    
    function disconnect() {
        
        emrp_dbhandler::$connected = !mysqli_close(emrp_dbhandler::$link);
        return !emrp_dbhandler::$connected;	
    }
	
    public static function staticDisconnect() {
    
	    if (emrp_dbhandler::$connected == true) {
              emrp_dbhandler::$connected = !mysqli_close(emrp_dbhandler::$link);
              return true;
	    } 
	    else {
	      return true;
	    }
    }
    
	/**
     * Execute a query string
     * @param String the query
     * @return void - throws exception in case of error
    */

    function executeQuery($query) {
    
	  try {
        if ($this->execute($query)) {
            self::$numRows = $this->lastNumRows();
            self::$lastInsertedId = mysqli_insert_id(emrp_dbhandler::$link);
            self::$affected = $this->lastAffected();
            return true;
        } 
        else {
            self::$error = htmlentities(self::$error,ENT_QUOTES);
            throw new exceptionMgr(self::$error);
        }
	  }
	  catch(exceptionMgr $e) {
	     throw new exceptionMgr(self::$error);
	  }
	  catch(Exception $e) {
         throw new exceptionMgr(self::$error);
	  }
    }
    
    private function execute($query) {
    
      $this->connect();

      if(emrp_dbhandler::$connected){
        try {
            self::$result = mysqli_query(emrp_dbhandler::$link, $query);
            self::$error = $this->lastError($query);
            if (self::$error) {
                throw new exceptionMgr(self::$error);
            } 
            else {
                return true;
            }
        }
	    catch(Exception $e) {
            throw new exceptionMgr(self::$error);
	     }
      }
      else{
        return false;
      }
    }    
    
    function fetchAssocList() {
    
	  try {
        if (self::$result and is_object(self::$result)) {
            $arrResult = array();
            while ($row = mysqli_fetch_assoc(self::$result)) {
                $arrResult[] = $row;		
            }
	    
            mysqli_free_result(self::$result);
            return $arrResult;
        } 
        else {
            return null;
        }
	  }
      catch(exceptionMgr $e) {
			$e->handleError();
	    }
	    catch(Exception $e) {
		    try {
               throw new exceptionMgr(self::$error);
		    }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
	   }
	}
	

   function getNumRows() {
   
      return self::$numRows;
   }
   
    private function lastError($query) {
 
	  try{
        if (mysqli_errno(emrp_dbhandler::$link)) {
            return 'Error Code : '.mysqli_errno(emrp_dbhandler::$link) . ' Error : ' . mysqli_error(emrp_dbhandler::$link) . ' Query: ' . $query;
        } 
        else {
            return null;
        }
	  }
	  catch(exceptionMgr $e) {
			$e->handleError();
	  }
	  catch(Exception $e) {
		    try {
               throw new exceptionMgr(self::$error);
		    }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
	  }
    }
    
    private function lastNumRows() {
    
	  try {
        if (self::$result and is_object(self::$result)) {
            return mysqli_num_rows(self::$result);
        } 
        else {
            return null;
        }
	  }
	  catch(exceptionMgr $e) {
			$e->handleError();
	  }
	  catch(Exception $e) {
		    try {
               throw new exceptionMgr(self::$error);
		    }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
	  }
    }
    
    private function lastAffected() {
    
	   try {
        if (self::$result) {
            return mysqli_affected_rows(emrp_dbhandler::$link);
        } 
        else {
            return null;
        }
	   }
	   catch(exceptionMgr $e) {
			$e->handleError();
	   }
	   catch(Exception $e) {
		    try {
               throw new exceptionMgr(self::$error);
		    }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
	    }
    }

    /**
     * Sanitize data
     * @param String - the data to be sanitized
     * @return String - the sanitized data
     */
    
    function getSanitizedData($string) {
      // echo $string;
	  try {
       if (!(emrp_dbhandler::$connected)) {
            $this->connect();
       }
       return mysqli_real_escape_string(emrp_dbhandler::$link,$string);
	  }
	  catch(exceptionMgr $e) {
			$e->handleError();
	  }
	  catch(Exception $e) {
		    try {
               throw new exceptionMgr(self::$error);
		    }
            catch (exceptionMgr $e) {
                $e->handleError();
            }
	  }
    }


   /**
     * Insert records into the database
     * @param String - the database table
     * @param array - data to insert field => value
     * @return bool
     */
    public function insertRecords( $table, $data )  {

      	// setup some variables for fields and values
    	$fields  = "";
		$values = "";
		
		// populate them
		foreach ($data as $f => $v) {
			
			$fields  .= "`$f`,";
			$v = $this->getSanitizedData($v); // sanitize data here (adding escape characters for the DB - suresh)
			//$values .= ( is_numeric( $v ) && ( intval( $v ) == $v ) ) ? $v."," : "'$v',";
			$values .="'$v',";
		}
		
		// remove trailing  ,
    	$fields = substr($fields, 0, -1);

    	// remove trailing  ,
    	$values = substr($values, 0, -1);
	
		$insert = "INSERT INTO $table ({$fields}) VALUES({$values})";
		
		try {
		  $this->executeQuery( $insert );
		  $msg = "Inserted a record. Query: ".$insert;
		  $this->em->logInfo($msg);
		  return true;
		}
		catch(exceptionMgr $e){
		  $e->handleError();
		  return false;
		}
		catch(Exception $e) {
		  return false;
		}
    }
    
    /**
     * Update records in the database
     * @param String - the table
     * @param array - of changes field => value
     * @param String - the condition
     * @return bool
     */
      public function updateRecords( $table, $changes, $condition ) {
    
    	$update = "UPDATE " . $table . " SET ";
	
	
    	foreach( $changes as $field => $value ) {
         $value = $this->getSanitizedData($value);
    		$update .= "`" . $field . "`='{$value}',";
    	}
    	   	
    	// remove trailing ,
    	$update = substr($update, 0, -1);
    	if( $condition != '' )
    	{
    		$update .= " WHERE " . $condition;
    	}
    	
    	try {
    	    $this->executeQuery( $update );
    	    $msg = "Updated a record. Query: ".$update;
    	    $this->em->logInfo($msg);
    	    return true;
    	}
    	catch(Exception $e) {
    	    return false;
    	}
   	
    }

    /**
     * Delete records from the database
     * @param String - the table to remove rows from
     * @param String - the condition for which rows are to be removed
     * @param int - the number of rows to be removed
     * @return void
     */
    public function deleteRecords($table, $condition, $limit = '')  {
    
    	$limit = ( $limit == '' ) ? '' : ' LIMIT ' . $limit;
    	$delete = "DELETE FROM {$table} WHERE {$condition} {$limit}";
    	try {
    	    $this->executeQuery( $delete );
    	    $msg = "Deleted a record. Query: ".$delete;
    	    $this->em->logInfo($msg);
    	    return true;
    	}
    	catch(Exception $e) {
    	    return false;
    	}
    }
    
    /**
    * Read records (one field) from a table
    * @param String - table name
    * @param String - name of the field from which records to be fetched
    * @param String - field name for where condition
    * @param String - value of the field name in the where condition
    * @param String - additional condition, if any  (can add if there are more to WHERE clause. for eg. ' AND club_id = $club_id' etc)
    * return array of results
    */
    
	 function readRecords($tablename, $get_fieldname, $where_fieldname, $where_fieldvalue, $additional_condition = '') {

     	$where_fieldvalue = $this->getSanitizedData($where_fieldvalue);
	
        $wherefvalue = ( is_numeric( $where_fieldvalue ) && ( intval( $where_fieldvalue ) == $where_fieldvalue ) ) ? $where_fieldvalue : "'$where_fieldvalue'";
	
         $query = "SELECT $get_fieldname FROM $tablename WHERE $where_fieldname = $wherefvalue";

    	  if( $additional_condition != '' )	{

    	 	  $query .= " ".$additional_condition;
        }
	
		
        $arrResult = array();  // to return empty array in case there is no matching result
	
        try {

		      $result = $this->executeQuery($query);

		      if($result){
		            if($this->getNumRows() > 0) {

                     $arrResult = $this->fetchAssocList();
       		             if($arrResult == null) {
				            throw new exceptionMgr("Failed to get the : ".$get_fieldname." : query: ".$query);
				         }
				         $msg = "Fetched records. Query: ".$query;
				         $em = new exceptionMgr($msg);
				         $em->logInfo($msg);
				         
                         return $arrResult;
			         }
			         else {
			             
                         return $arrResult;   // this will send empty array
			         }
		       }
               else {
		    	     throw new exceptionMgr("Failed to get the : ".$get_fieldname." : query: ".$query);
		       }
		  }
		  catch(exceptionMgr $e){
		       $e->handleError();
		       return false;
		  }
		  catch(Exception $e){
		       return false;
		  }
	 }

    /**
     * Read records (multiple fields) from a table
     * @param String - the table
     * @param array - of fieldnames to read
     * @param String - the condition
     * @return bool
     */
    public function readRecordsMultipleFields( $table, $fieldnames, $where_condition = '', $additional_condition='' ) {

    	$selectquery = "SELECT ";
    	foreach( $fieldnames as $field)
    	{
    		$selectquery .= $field.",";
    	}
    	// remove trailing , (ie remove the comma added at the end of last fieldname)
    	$selectquery = substr($selectquery, 0, -1);
    	
      $selectquery .= " FROM ".$table;
      
    	if( $where_condition != '' )
    	{
    		$selectquery .= " WHERE " . $where_condition;
    	}
	
   	if( $additional_condition != '' )
    	{
    		$selectquery .= " ".$additional_condition;
    	}

      $arrResult = array();  // to return empty array in case there is no matching result

      try {

		      $result = $this->executeQuery($selectquery);

		      if($result){
		          if($this->$getNumRows() > 0) {

                     $arrResult = $this->fetchAssocList();
       		             if($arrResult == null) {
				            throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
				         }
				         $msg = "Fetched records. Query: ".$selectquery;
				         $this->em->logInfo($msg);
				         
                         return $arrResult;
			         }
			         else {
                     return $arrResult;   // this will send empty array
			         }
		       }
             else {
				       throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
		    	 }
		}
		catch(exceptionMgr $e){
		       $e->handleError();
		}
    }


    /**
     * Read records (all fields) from the table (SELECT *)
     * @param String - the table
     * @param array - of fieldnames to read
     * @param String - the condition
     * @return bool
     */
    public function readRecordsAllFields( $table, $where_condition ='', $additional_condition='') {

    	$selectquery = "SELECT * ";
    	
        $selectquery .= " FROM ".$table;
      
     	if( $where_condition != '' )
    	{
    		$selectquery .= " WHERE " . $where_condition;
    	}
	
   	if( $additional_condition != '' )
    	{
    		$selectquery .= " ".$additional_condition;
    	}
	
        $arrResult = array();  // to return empty array in case there is no matching result
	
	    try {

		      $result = $this->executeQuery($selectquery);

		      if($result){
		          if($this->getNumRows() > 0) {

				$arrResult = $this->fetchAssocList();
       		         
			             if($arrResult == null) {
				            throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
				         }
				         
				         $msg = "Fetched records. Query: ".$selectquery;
				         $this->em->logInfo($msg);
				         
		                 return $arrResult;
			         }
			         else {
				   return $arrResult;   // this will send empty array
			         }
		       }
			else {
				       throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
		    	 }
		}
		catch(exceptionMgr $e){
		       $e->handleError();
		}
    }



    
    /**
    * get the count of records
    *
    * @param String - table name
    * @param String - name of the field to read
    * @param String - the condition (where condition in the SQL query. to count only unique records, 'where' condition may include DISTINCT keyword)
    * @return  - count of the records (0 if there is no record)
    *
    */
    public function getRecordsCount( $table, $fieldname, $condition ) {
    
      $query = "SELECT count($fieldname) FROM $table";

      $recordscount = 0;
      
      try {

		      $result = $this->executeQuery($selectquery);

		      if($result){
		            if($this->getNumRows() > 0) {

                     $arrResult = $this->fetchAssocList();
       		         if($arrResult == null) {
				            throw new exceptionMgr("Failed to get the records count : query: ".$selectquery);
				         }
                     $recordscount = $arrResult[0]['count($fieldname)'];
                     return $recordscount;
			         }
			         else {
                     return $recordscount;
			         }
		       }
             else {
				       throw new exceptionMgr("Failed to get the records count : query: ".$selectquery);
		    	 }
		}
		catch(exceptionMgr $e){
		       $e->handleError();
		}
    }
    
public function readRecordsWithQuery( $selectquery) {

        

      $arrResult = array();  // to return empty array in case there is no matching result

      try {

              $result = $this->executeQuery($selectquery);

              if($result){
                    if($this->getNumRows() > 0) {

                     $arrResult = $this->fetchAssocList();
                         if($arrResult == null) {
                            throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
                         }
                         
                         $msg = "Fetched records. Query: ".$selectquery;
                         $this->em->logInfo($msg);
                         
                         return $arrResult;
                     }
                     else {
                     return $arrResult;   // this will send empty array
                     }
               }
             else {
                       throw new exceptionMgr("Failed to read the records : query: ".$selectquery);
                 }
        }
        catch(exceptionMgr $e){
               $e->handleError();
        }
    }
}
?>