<?php

/**
* Class to hold utility functions
*
*/

 class util_PhoneNumberFormatChanger {
 
    function formatPhoneNumber_UItoDB($inputstr) {

         $removeChars = array("(", ")", "-", " ");
		   return str_replace($removeChars, "", $inputstr );
    }
    
    function formatPhoneNumber_DBtoUI($phonenum) {

       if($phonenum != '') {
			  $phonenum_str1 = substr($phonenum, 0, 3); // 0- start index. 3-number elements. ie 0 till 2.
			  $phonenum_str2 = substr($phonenum, 3, 3); // elements 3,4,5
			  $phonenum_str3 = substr($phonenum, 6, 4); // elements 6,7,8,9

           $phonenum = $phonenum_str1."-".$phonenum_str2."-".$phonenum_str3;
	    }
	    return $phonenum;
	    
    }
    
 }
 
?>