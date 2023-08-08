<?php
session_start();
/**
* File: logMgr.php
*
* A Class to log messages to a file. The Class provides roll-over facility as well.
* Messages with log levels higher than the set global level will be ignored.
*
* Author: Suresh Kodoor
*
* Following parameters are set through the configuration file (initially).
* Values can also be set on the 'instance' using the 'set' methods.
*
* cfg_globalLogLevel- integer (0-7)
* cfg_logfilename - logfile name
* cfg_logrolloversize - filesize at which roll-over is initiated (in MB)
* cfg_maxarchivelogfiles - how many archive logfiles to keep before overwritting
*
*/


require_once($_SESSION['EMRP_CONFIG_FILE']);  //config file
require_once($_SESSION['EMRP_BASE_DIR']."/app/boot/checksandincludes.php");

class logMgr {

    public static $LG_DEBUG    = 8;
    public static $LG_INFO     = 7;
    public static $LG_NOTICE   = 6;
    public static $LG_WARNING  = 5;
    public static $LG_ERROR    = 4;
    public static $LG_CRITICAL = 3;
    public static $LG_ALERT    = 2;
	public static $LG_AUDIT    = 1;
    public static $LG_EMERG    = 0;

	private static $LG_DELIM = "\t";  // delimiter that seperates individual fields in the log message in the logfile

    private static $instance = null;
    private $logfilename;
    private $globalLogLevel;
	private $logfhandle = null;
	
	private $logrolloversize = 0; //in bytes. 0 means the roll-over is disabled
	private $maximumArchiveLogFiles; //How many log files should be preserved while rollover before overwritting (excluding the current logfile).

 	private $isIdentLogLevelSet = false; // Log level associated with the module identified by 'ident'. This could be used to set log-level at a Club level.
	
    private function __construct($loglvl, $logfname, $rolloversize, $maxarchives) {

        $this->globalLogLevel = $loglvl;
		$this->logfilename = $_SESSION['EMRP_BASE_DIR']."/logfiles/".$logfname;
		$this->logrolloversize = $rolloversize * 1024 * 1024; // in bytes
		$this->maximumArchiveLogFiles = $maxarchives;
    }

 	public static function getInstance()  {
     
	    global $cfg_globalLogLevel, $cfg_logfilename, $cfg_logrolloversize, $cfg_maxarchivelogfiles;
	
        if (!logMgr::$instance instanceof self) {
            logMgr::$instance = new logMgr($cfg_globalLogLevel, $cfg_logfilename, $cfg_logrolloversize, $cfg_maxarchivelogfiles);
        }
        return logMgr::$instance;
    }

    /**
    * To Log a message to the logfile
    *
    * @Param - string - Identifies string. this string will be prefixed to the message
    *                   this could be the clubcode, for example.
    * @Param - string - the logging message string
    * @Param - int - the loglevel for the message. The message will be logged
    *                only if this level is less than the set global loglevel.
    *                possible values are the defined 8 levels (LG_DEBUG, LG_INFO etc)
    *
    */

    public function writeToLog($ident,$strMessage,$msglevel) {

          global $cfg_loggingOn;
          

		  if(!$cfg_loggingOn)
			  return;         // If logging is off, return (open logging file in logMgr is at times causing 'out of memory' error on the Server.
		                       // so, better keep it off on the LIVE server
    
	      // Check if the message log level is outside the Log level set

		  if($msglevel > $this->globalLogLevel) { // The message log level is outside the global log level set
			  return;
		  }



          // If file is not opened, open the logfile
	      
		  try {
		      if($this->logfhandle == null) {
			     $this->openLogFile();
		      }
		  }
		  catch(Exception $e) { // failed to open logfile. return
		      return;       
		  }
		  
		  // Write the log

		  try {

           $timestamparr = getdate();
           $LOG_ENTRY_ID =  $timestamparr[0]; // this is the 'seconds since Unix Epoch' value
                                              // LOG_ENTRY_ID can be used to uniquely identifies a log entry. Can be displayed to the customer with error message
                                              // so that the customer can quote/send that Id to the product support personal while reporting error.
              
			  $timestampstr = $timestamparr['mday']."-".$timestamparr['mon']."-".$timestamparr['year'].":".$timestamparr['hours'].":".$timestamparr['minutes'].":".$timestamparr['seconds'];

			  $logmsg = $LOG_ENTRY_ID.logMgr::$LG_DELIM.$ident.logMgr::$LG_DELIM.$timestampstr.logMgr::$LG_DELIM.$strMessage."\n";

              if(!fwrite($this->logfhandle, $logmsg)) {
                  throw new exceptionMgr("Exception with fwrite in writeToLog.");
			  }

			  if($this->logrolloversize != 0) {
				  $fsize = 0;
				  if(file_exists($this->logfhandle)) {
				    if(!($fsize = filesize($this->logfhandle))) {
                      throw new exceptionMgr("Failed with filesize in writeToLog.");
				    }
				  }
				  if($fsize >= $this->logrolloversize) {
                      $this->rollover();
				  }
			  }
		  }
          catch (exceptionMgr $e) {
                $e->handleError();
          }
		  catch(Exception $e) {
				try {
                  throw new exceptionMgr("Exception in writeToLog.");
				}
                catch (exceptionMgr $e) {
                  $e->handleError();
                }
		  }
		  
		  return  $LOG_ENTRY_ID;
 
    }

    private function openLogFile() {
        
		  try {
                if(!($this->logfhandle = @fopen($this->logfilename,"a"))) {  // @ at the beggining to hide any error output
				   throw new exceptionMgr("Failed to open logfile (".$this->logfilename);
			    }
		  }
          catch (exceptionMgr $e) {
                $e->handleError();
          }
		  catch(Exception $e) {
				try {
                  throw new exceptionMgr("Failed to open logfile (".$logfilename);
				}
                catch (exceptionMgr $e) {
                  $e->handleError();
                }
		  }
	}

    private function rollover() {

          try {
              $count = $this->maximumArchiveLogFiles;

			  $fname = $this->logfilename.$count;

              if(file_exists($fname)) {
				  if(!unlink($fname)) {  // Delete the oldest logfile
					  throw new exceptionMgr("Failed to delete logfile while roll-over.");
				  }
			  }
              $counts -= 1; // decrement the count

              do {
			     $sfname = $this->logfilename.$count;      // file to rename
				 $tfname = $this->logfilename.($count+1);  // new name of the file

                 if(file_exists($sfname)) {
					 if(!rename($sfname, $tfname)) {
					   throw new exceptionMgr("Failed to rename archive logfile".$count." while roll-over.");
					 }
			     }
                 $counts -= 1; // decrement the count
		      }while($count == 0);

			  // now copy the current file
              if(file_exists($this->logfilename)) {
			     $sfname = $this->logfilename;      // current file
				 $tfname = $this->logfilename.($count+1);  // new name of the file
				 if(!rename($sfname, $tfname)) {
					   throw new exceptionMgr("Failed to rename the current logfile while roll-over.");
				 }
			  }

			  // now open a new logfile
			  $this->openLogFile();
		  }
          catch (exceptionMgr $e) {
                $e->handleError();
          }
		  catch(Exception $e) {
				try {
                  throw new exceptionMgr("Exception while logfile roll-over.");
				}
                catch (exceptionMgr $e) {
                  $e->handleError();
                }
		  }
	}

	public function setGlobalLogLevel($loglvl) {

		$this->globalLogLevel = $loglvl;
	}

	public function getGlobalLogLevel() {

		return $this->globalLogLevel;
	}

	public function setIdentLogLevel($identstr, $loglvl) {

        $this->isIdentLogLevelSet = true;
		$this->identLogLevel[$identstr] = $loglvl;
	}

	public function resetIdentLogLevel($identstr) {

        $this->isIdentLogLevelSet = false;
	}

	public function getIdentLogLevel($identstr) {

		return $this->identLogLevel[$identstr];
	}

	public function setLogFileName($logfname) {

		$this->logfilename = $logfname;
	}

	public function getLogFileName() {

		return $this->logfilename;
	}

	public function setLogRolloverSize($rolloversize) { // rolloversize is in MB

        $this->logrolloversize = $rolloversize * 1024 * 1024;
	}
	
	public function getLogRolloverSize() {

        return $this->logrolloversize;
	}
	

	public function disableLogRollover() {

        $this->logrolloversize = 0; 
	}


    function __destruct() {

		  try {
              if(!@fclose($this->logfhandle)) {
                  throw new exceptionMgr("Exception on closing the logfile ".$this->logfilename);
			  }
		  }
          catch (exceptionMgr $e) {
               // $e->handleError();
          }
		  catch(Exception $e) {
				try {
                  throw new exceptionMgr("Exception on closing the logfile ".$this->logfilename);
				}
                catch (exceptionMgr $e) {
                  $e->handleError();
                }
		  }
	}
}

?>
