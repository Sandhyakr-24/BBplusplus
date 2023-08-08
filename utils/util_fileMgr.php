<?php

class util_fileMgr {

	private $arr_valid_file_extensions;      // eg. jpeg, gif, png (defined in the configuration file)
	
	// Maximum allowed size for file upload. Default is defined in php.ini configuration file.
	private $upload_maximum_filesize_phpini; // ini_get('upload_max_filesize');

    // The error code and descriptions are at www.php.net/manual/en/features.file-upload.errors.php. Error code 5 missing
    public static $FILEUPLOAD_ERROR_MSG = array('The file uploaded successfully',
         'File to upload exceeded the max size set in the configuration PHP.INI', // File size exceeded the maximum size set in php.ini file
         'The uploaded file exceeds the MAX_FILE_SIZE specified',  // ie MAX_FILE_SIZE specified in the HTML form with file upload element
         'The uploaded file was only partially uploaded',
         'No file was uploaded',
         'Missing a temporary folder',
         'Failed to write file to disk. ',
         'File upload stopped by extension');
   
   
   function __construct($strValidFileExtensions = "") {

      if($strValidFileExtensions != '') {
      
        $strValidextensions = trim($strValidFileExtensions);
        $this->arr_valid_file_extensions = explode(",", $strValidextensions);
      }
      else {
        $arr_valid_file_extensions = array();
      }
   }
    
   function setValidFileExtensions($strValidFileExtensions) {

      $strValidextensions = trim($strValidFileExtensions);
      $this->arr_valid_file_extensions = explode(",", $strValidextensions);
   }

   // returns an array. result['saved_filename'] will be '' if failed. Will have the filename if success
   // arrResult['status_message'] will have the error/success message filled-in
   
	function uploadFile($localfilename='', $server_temp_filename='', $server_target_fullpath_filename=''){

         $arrResult = array();
         $arrResult['saved_filename'] = '';
         $arrResult['status_message'] = '';
         
         // find the extension of the file
         $lastdot = strrpos($localfilename, '.'); // get last occurance of the '.'
         if($lastdot === FALSE) {  //To avoid the mistake between the return values '0' for "the character found at position 0" and
                                   //"character not found", use the '===' (3 equals) sign to compare
            $arrResult['status_message'] = 'File upload failed. Could not determine the extension of the file.';
            return $arrResult;
         }

         $extension = substr($localfilename,($lastdot+1)); // plus 1 to count for the '.'

         if(!$this->isValidExtension($extension)){
            $validextensions = implode(", ",$this->arr_valid_file_extensions);
            $arrResult['status_message'] = 'File upload failed. Invalid file extension. Supported extensions are: '.$validextensions;
            return $arrResult;
         }
         
         if(($localfilename == '') || ($server_temp_filename == '') || ($server_target_fullpath_filename == '')){

            $arrResult['status_message'] = 'File upload failed (filename is null).';
            return $arrResult;
         }

         $target_filename =$server_target_fullpath_filename."/" .$localfilename;
         
         // upload the file
         $arrResult = $this->upload($localfilename, $server_temp_filename, $target_filename);
         
         return($arrResult);
   }
   
   private function upload($localfilename='', $temp_filename='', $target_filename='') {

         $arrResult = array();
         $arrResult['saved_filename'] = '';
         $arrResult['status_message'] = '';

         try {
         
            if(is_uploaded_file($temp_filename)){ //9448471095
		
		
		
            
			         if(move_uploaded_file($temp_filename,$target_filename)){
						   $arrResult['status_message'] = "File upload Successful.";
						   $arrResult['saved_filename'] =  $target_filename;
					   }
                  else{
						   $arrResult['status_message'] = "File upload failed.";
					   }
				}
		   }
         catch(Exception $e){
			   $arrResult['status_message'] = "File upload failed.";
			   return($arrResult);
   		}

			return($arrResult);
	}

	function deleteFile($filename) {
		 
		 try {
			 $rtn = unlink($filename);
			 return($rtn);
		 }
		 catch(Exception $e) {
			 return(false);
		 }
	}

	function isValidExtension($extension){

			$isValid = FALSE;
		
		       if(is_array($this->arr_valid_file_extensions)) {
		       
			 foreach($this->arr_valid_file_extensions as $validextension) {
					   if (strcasecmp($validextension, $extension)==0) {
						   $isValid = TRUE;
						   break;
					   }
				    }
				 }
				 return $isValid;
	}
	
	function moveFile( $server_temp_filepath, $server_target_fullpath_filename){
		//echo "mv $server_temp_filepath $server_target_fullpath_filename";exit;
		return $res=exec("mv  $server_temp_filepath  $server_target_fullpath_filename");
		
		
	}
	
	
}
?>