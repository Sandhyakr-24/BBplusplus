<?php

/**
* Class to convert Date format to/from DB/UI
*
*/

 class util_DateFormatChanger {
 
    function formatDate_DBtoUI($strDate) {
    
         if($strDate == '') {
           return $strDate;
         }

         $arrdate = explode("-" , $strDate);  
         $strPrdate  = $arrdate[2].'-'.$arrdate[1].'-'.$arrdate[0];
 	 return $strPrdate;
    }
    
    function formatDate_UItoDB($strDate) {

         // UI format is MM-DD-YYYY
	 // DB format is YYYY-MM-DD
	 
         if($strDate == '') {
           return $strDate;
         }
	 
	 if(substr_count($strDate,"-") > 1)
	    $delimit = "-";
	 else if(substr_count($strDate,"/") > 1)
	    $delimit = "/";
	 else
	    $delimit = $strDate[3];  // get the char at index 3
	    
	 $arrdate = explode($delimit, $strDate);
 	 $strDbDate = $arrdate[2].'-'.$arrdate[1].'-'.$arrdate[0];

	 return $strDbDate;
    }
}
 
?>