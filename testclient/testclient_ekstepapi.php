<?php ?>
<html>

<head>

<script src="http://localhost/AksharaServiceAPI/scripts/jquery-3.2.1.min.js"> </script>

<script language="javascript">


function run() {

    $.ajax({
         dataType: "json",
         url: "https://qa.ekstep.in/api/v1/telemetry", 
         data: {
            id: "ekstep.telemetry" ,
            ver:"1.0",
            ts:"2017-11-25T00:00:00"

    },
    success: function( data ) {
            alert(data);
            $( "#temp" ).html( "<strong>" + data +"</strong>" );
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

EkSTEP API Testing page

</body>

</html>
