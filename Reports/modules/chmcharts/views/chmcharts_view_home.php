<?php

    session_start();
    
    class chmcharts_view_home {
        
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
                 
                    <!--  PANEL1 ROW STARTS -->
                
                    <div class="row" id="row-chartpanelsrow1" style="width:100%;margin:0px;padding:1%;">
                        <div class="col" id="column1-chartpanelsrow1" style="width:100%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                        
                        <div><a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-1" role="button" href="#collapse-1">Show <?php echo $charts[0]['chart_name'];?> Chart</a>
                         <div class="collapse" id="collapse-1">
                        
                            <div class="card" id="panel-chart1" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[0]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                                                    
                                    <!--  CHART1 -->
    								<canvas id="chart1" style="width: 80%; padding-left:5%"></canvas>

                                </div>
                            </div>
                            
                         </div></div>   <!--  end of 'collapse' divs -->
                            
                        </div>
                    </div>
                    
                    <!--  PANEL2 ROW STARTS -->
                    
                    <div class="row" id="row-chartpanelsrow2" style="width:100%;margin:0px;padding:1%; ">
                        <div class="col" id="column1-chartpanelsrow2" style="width:100%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                        
                        <div><a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-2" role="button" href="#collapse-2">Show <?php echo $charts[1]['chart_name'];?> Chart</a>
                          <div class="collapse" id="collapse-2">
                        
                        
                            <div class="card" id="panel-chart3" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[1]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                    <!--  CHART3 -->
    							 	<canvas id="chart2" style="width: 80%; padding-left:5%"></canvas>                                 
 
                                </div>
                            </div>
                            
                           </div></div>   <!--  end of 'collapse' divs -->
                             
                        </div>
                    </div>
                    
                    <!--  PANEL3 ROW STARTS -->
                    
                     <div class="row" id="row-chartpanelsrow3" style="width:100%;margin:0px;padding:1%;">
                        <div class="col" id="column1-chartpanelsrow2" style="width:100%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                        
                         <div><a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-3" role="button" href="#collapse-3">Show <?php echo $charts[2]['chart_name'];?> Chart</a>
                          <div class="collapse" id="collapse-3">                       
                        
                        
                            <div class="card" id="panel-chart3" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[2]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                    <!--  CHART3 -->
    							 	<canvas id="chart3" style="width: 80%;padding-left:5%"></canvas>                                 
 
                                </div>
                            </div>
                            
                            </div></div>   <!--  end of 'collapse' divs -->
                            
                        </div>
                    </div>    
                    
                    
                    <!--  PANEL4 ROW STARTS -->               
                    
                     <div class="row" id="row-chartpanelsrow4" style="width:100%;margin:0px;padding:1%;">
                        <div class="col" id="column1-chartpanelsrow2" style="width:100%;background-color:#ffffff;background-size:cover;background-repeat:repeat;">
                        
                          <div><a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-4" role="button" href="#collapse-4">Show <?php echo $charts[3]['chart_name'];?> Chart</a>
                            <div class="collapse" id="collapse-4"> 
                          
                            <div class="card" id="panel-chart3" style="height:100%;margin-top:0%;margin-bottom:0%;background-size:cover;background-repeat:no-repeat;background-color:#ffffff;">
                                <div class="card-header">
                                    <h5 class="mb-0"><?php echo $charts[3]['chart_name'];?></h5>
                                </div>
                                <div class="card-body" style="height:100%;padding:0px;">
                                    <p class="card-text" style="padding:0px;"></p>
                                    
                                    <!--  CHART4 -->
    							 	<canvas id="chart4" style="width: 80%;  padding-left:5%"></canvas>                                 
 
                                </div>
                            </div>
                            
                           </div></div>   <!--  end of 'collapse' divs -->
                                
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
    
 
<!--  Chart#1  Game Utilization Metrics -->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart1_json;?>');
var backgroundclr = new Array(); 
var borderclr = new Array(); 

for(var i = 0; i < chartvalues.length; i++) {

    var val = chartvalues[i]['GameId']; 
	labelvalues.push(val);
	chartdata.push(chartvalues[i]['PlaySessions']); 

	backgroundclr.push('rgba(10, 10, 250, 0.6)'); // can specify seperate color or same color for each bar
	borderclr.push('rgba(0, 50, 255, 1)'); // can specify seperate color or same color for each bar
}

var ctx = document.getElementById("chart1").getContext('2d');
 
var dbChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelvalues,
        datasets: [{
            label: 'Play Sessions',
            data: chartdata,
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
    
<!--  Chart#2  Weekly Registration Stats -->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart2_json;?>');
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

var ctx = document.getElementById("chart2").getContext('2d');
 
var dbChart1 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labelvalues,
        datasets: [{
            label: 'Registration Count',
            data: chartdata,
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
    
<!--  Chart#3  Daily Game Play Session Stats-->
 
 <script>
var labelvalues = new Array();
var chartdata = new Array();
var chartvalues = JSON.parse('<?= $chartsdata_chart3_json;?>');
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

var ctx = document.getElementById("chart3").getContext('2d');
 
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

var ctx = document.getElementById("chart4").getContext('2d');
 
var dbChart5 = new Chart(ctx, {
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