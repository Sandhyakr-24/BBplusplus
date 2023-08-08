<?php
     global $scriptsdirurl;
     global $scriptsimagedirurl;
     global $bootstrapdirscriptsdirurl;

     $scriptsdirurl = $_SESSION['EMRP_BASE_URL']."app/views/scripts";
     $scriptsimagedirurl = $_SESSION['EMRP_BASE_URL']."app/views/scripts";
     
     $bootstrapdirscriptsdirurl = $_SESSION['EMRP_BASE_URL']."app/bootstrapdir";
?>

    <script src="<?php echo $scriptsdirurl;?>/jquery-3.2.1.min.js"> </script>
    <script src="<?php echo $bootstrapdirscriptsdirurl;?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $bootstrapdirscriptsdirurl;?>/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $bootstrapdirscriptsdirurl;?>/assets/js/bs-animation.js"></script> 

