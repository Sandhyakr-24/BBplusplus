<?php

    session_start();
    
    class prmhome_view_dashboard {
        
    function show($args ="", $arrErrorMsg = "") {
        
        $charts = $args['charts'];
        $chartsdata = $args['chartsdata'];
        
        $chartsdata_chart1_json = json_encode($chartsdata[0]);
        $chartsdata_chart2_json = json_encode($chartsdata[1]);
        $chartsdata_chart3_json = json_encode($chartsdata[2]);
        $chartsdata_chart4_json = json_encode($chartsdata[3]);
        
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMRP Reports Portal</title>
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_header.php"); 
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_mdchart_cssfiles.php");
    ?>
</head>

<body>
 
<?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_headerpanel.php"); ?>
  
    <div>
        <div class="container" style="margin:0px;padding:0px; height:100%">
            <div class="row" style="width:100%;min-width:100%;max-width:100%;margin:0px;height:100%;">
            
                 <!--  can include  'emrp_sidemenupanel.php' here, if sidebar menu is required -->
 
                <div class="col" id="column-rightcharts" style="max-width:110%;width:100%; height:100%">
                
                    <div class="row" id="row-chartpanelsrow1" style="width:100%;height:50%;margin:0px;padding:1%;">
                        <div class="col" id="column1-chartpanelsrow1" style="width:50%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                            <div class="card" id="panel-chart1" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[0]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                 
                                    <!--  CHART1 -->
    								<canvas id="dashboardChart1" style="width: 100%; height: 100%; padding-left:2%"></canvas>

                                </div>
                            </div>
                        </div>

                        <div class="col" id="column2-chartpanelsrow1" style="width:50%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                            <div class="card" id="panel-chart2" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[1]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                      <!--  CHART2 -->
    								<canvas id="dashboardChart2" style="width: 100%; height: 100%; padding-left:2%"></canvas>                                  
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" id="row-chartpanelsrow2" style="width:100%;height:50%;margin:0px;padding:1%; padding-bottom:10%">
                        <div class="col" id="column1-chartpanelsrow2" style="width:50%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                            <div class="card" id="panel-chart3" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[2]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                    <!--  CHART3 -->
    							 	<canvas id="dashboardChart3" style="width: 100%; height: 100%; padding-left:2%"></canvas>                                 
 
                                </div>
                            </div>
                        </div>
                        <div class="col" id="column2-chartpaneslrow2" style="width:50%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                            <div class="card" id="panel-chart4" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[3]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                    <!--  CHART4 -->
    							 	<canvas id="dashboardChart4" style="width: 100%; height: 100%; padding-left:2%"></canvas>  
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <?php include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/emrp_footer.php");  
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_scripts.php"); 
          include($_SESSION['EMRP_BASE_DIR']."/app/views/includes/include_mdchart_scripts.php");
    ?>
    
    
<!--  Chart#1  Weekly Registration Stats -->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart1_json;?>');
var backgroundclr = new Array(); 
var borderclr = new Array(); 

for(var i = 0; i < chartvalues.length; i++) {
    // var val = chartvalues[i]['RegWeek']+'/'+chartvalues[i]['RegYear'];
    var val = 'Wk#'+chartvalues[i]['RegWeek']; // Number indicating week of the year. If zero data, that week is not shown
	labelvalues.push(val);
	chartdata.push(chartvalues[i]['RegistrationCount']); 

	backgroundclr.push('rgba(54, 162, 235, 0.8)'); // can specify seperate color or same color for each bar
	borderclr.push('rgba(20, 20, 255, 1)'); // can specify seperate color or same color for each bar
}

var ctx = document.getElementById("dashboardChart1").getContext('2d');
 
var dbChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelvalues,
        datasets: [{
            label: 'Registration Count',
            data: chartdata,
            //backgroundColor: [
               // 'rgba(255, 99, 132, 0.2)',
              //  'rgba(54, 162, 235, 0.2)'
              //  'rgba(255, 206, 86, 0.2)',
              //  'rgba(75, 192, 192, 0.2)',
              //  'rgba(153, 102, 255, 0.2)',
              //  'rgba(255, 159, 64, 0.2)'
           // ],
           // borderColor: [
              //  'rgba(255,99,132,1)',
             //   'rgba(54, 162, 235, 1)'
              //  'rgba(255, 206, 86, 1)',
             //   'rgba(75, 192, 192, 1)',
             //   'rgba(153, 102, 255, 1)',
             //   'rgba(255, 159, 64, 1)'
           // ],
           backgroundColor: backgroundclr,
           borderColor: borderclr,
           borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
    
<!--  Chart#2  Daily Game Play Session Stats-->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart2_json;?>');
var backgroundclr = new Array(); 
var borderclr = new Array(); 

for(var i = 0; i < chartvalues.length; i++) {
    // var val = chartvalues[i]['RegWeek']+'/'+chartvalues[i]['RegYear'];
    var val = chartvalues[i]['SessionDate']; 
 	labelvalues.push(val);
	chartdata.push(chartvalues[i]['GameplaySessionsCount']); 

	backgroundclr.push('rgba(255, 99, 132, 0.8)'); // can specify seperate color or same color for each bar
	borderclr.push( 'rgba(255,20,20,1)'); // can specify seperate color or same color for each bar
}

var ctx = document.getElementById("dashboardChart2").getContext('2d');
 
var dbChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelvalues,
        datasets: [{
            label: 'Gameplay Sessions Count',
            data: chartdata,
            backgroundColor: backgroundclr,
            borderColor: borderclr,
            borderWidth: 1,
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }],
   			xAxes: [{
                ticks: {
                    autoSkip:false  // to avoid automatic skipping of some x-axis labels
                }
    		}]
        }
    }
});
</script>


<!--  Chart#3  Competency Highlevel Summary (based on number of attempts across game play sessions across all games) -->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart3_json;?>');
var backgroundclr = new Array(); 
var hoverbackgroundclr = new Array(); 

for(var i = 0; i < chartvalues.length; i++) {

    var val = chartvalues[i]['attempts']; 
 	labelvalues.push(val);
	chartdata.push(chartvalues[i]['submissioncount']); 

	// generate a random color hex code
	var randomColor = "#000000".replace(/0/g,function(){return (~~(Math.random()*16)).toString(16);});
	backgroundclr.push(randomColor); 
	borderclr.push("#FF5A5E"); 
}

var ctx = document.getElementById("dashboardChart3").getContext('2d');
 
var dbChart3 = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: labelvalues,
        datasets: [{
            data: chartdata,
            backgroundColor: backgroundclr,
            hoverBackgroundColor: hoverbackgroundclr,
        }]
    },
    options: {
        responsive: true,
        labels:false,
        title: {
            display: true,
            text: "#of Correct Submissions in '1-5' Attempts"
        }        
    }

});
</script>


<!--  Chart#4  Total number of registered Children from Govt School Vs Private School -->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart4_json;?>');
var backgroundclr = new Array(); 
var hoverbackgroundclr = new Array(); 

for(var i = 0; i < chartvalues.length; i++) {

    var val = chartvalues[i]['School Type']; 
 	labelvalues.push(val);
	chartdata.push(chartvalues[i]['Child Count']); 

	// generate a random color hex code
	var randomColor = "#000000".replace(/0/g,function(){return (~~(Math.random()*16)).toString(16);});
	backgroundclr.push(randomColor); 
	borderclr.push("#FF5A5E"); 
}

var ctx = document.getElementById("dashboardChart4").getContext('2d');
 
var dbChart4 = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: labelvalues,
        datasets: [{
            data: chartdata,
            backgroundColor: backgroundclr,
            hoverBackgroundColor: hoverbackgroundclr,
        }]
    },
    options: {
        responsive: true,
        labels:false,
        title: {
            display: true,
            text: "#of Registrations: Govt-Pvt Schools"
        }        
    }

});
</script>
    
</body>

</html>
<?php
    }
    
    }

?>