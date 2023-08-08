<?php ?>
<html>

<head>

<script src="http://localhost/AksharaServiceAPI/scripts/jquery-3.2.1.min.js"> </script>

<script type="text/javascript">


function run() {
 alert('in run');
  $.ajax({
      dataType: "json",

      url: "http://localhost/abs/api/register.php",
      data: {
           name: "testname3" ,
           phone:"1234567890",
           age:"12",
           grade:"5th Grade",
           schooltype:"0",
           geo:"12345,67890",
           language:"KANNADA"    
      },
      success:function(data) {
           alert(data);
           alert('success');
      },
      error:function(data) {
          alert('error');
          alert(data);
      } 
   });
}

// We'll run the AJAX query when the page loads.
window.onload=run;

</script>

</head>

<body>

ABS API Test client

</body>

</html>
