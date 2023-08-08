<?php
   // to run #php -q testbase64.php

   $contentstr = file_get_contents("testpicture.png");
   $base64imagestring = base64_encode($contentstr);
   echo "base64encoded string: ".$base64imagestring;
   file_put_contents("outputfile.png",base64_decode($base64imagestring));

?>
