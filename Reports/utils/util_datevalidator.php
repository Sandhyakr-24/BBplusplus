<?php
   /**
    *
    * Validate a date
    *
    * @param    string    $date
    * @param    string    format
    * @return    bool
    *
    */
    

class util_datevalidator {

    function validateDate( $date, $format='YYYY-MM-DD')  {

        switch( $format ) {

            case 'YYYY/MM/DD':
            case 'YYYY-MM-DD':
            list( $y, $m, $d ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'YYYY/DD/MM':
            case 'YYYY-DD-MM':
            list( $y, $d, $m ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'DD-MM-YYYY':
            case 'DD/MM/YYYY':
            list( $d, $m, $y ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'MM-DD-YYYY':
            case 'MM/DD/YYYY':  
            list( $m, $d, $y ) = preg_split( '/[-\.\/ ]/', $date );
            break;

            case 'YYYYMMDD':
            $y = substr( $date, 0, 4 );
            $m = substr( $date, 4, 2 );
            $d = substr( $date, 6, 2 );
            break;

            case 'YYYYDDMM':
            $y = substr( $date, 0, 4 );
            $d = substr( $date, 4, 2 );
            $m = substr( $date, 6, 2 );
            break;

            default:
                return false; // Invalid Date Format
        }

        if((strlen($y) != 4) || (strlen($d) != 2) || (strlen($m) != 2)) // should be in YYYY (4digits), MM (2digits) and DD (2digits) format
             return false;
             
        return checkdate( $m, $d, $y );  // returns true for a valid date. false for invalid date
    }
}
?>
