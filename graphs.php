<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<?php

/* Include the `fusioncharts.php` file that contains functions	to embed the charts. */
//session_start();
include('database.php');
include('header.php');

   include("includes/fusioncharts.php");

?>

<html>
   <head>
    <link rel="stylesheet" type="text/css" href="css/graph.css">

  	<!-- You need to include the following JS file to render the chart.
  	When you make your own charts, make sure that the path to this JS file is correct.
  	Else, you will get JavaScript errors. -->
<script type="text/javascript" src="fusioncharts/js/fusioncharts.js"></script>
<script type="text/javascript" src="fusioncharts/js/themes/fusioncharts.theme.fint.js"></script>
<script>
function link_highlight() {
	if (document.location.pathname == "/graphs.php"){
		document.getElementById("daily").style.backgroundColor = "#70f380";
	}
	
	else if(document.location.pathname == "/graph_week.php"){
		document.getElementById("weekly").style.backgroundColor = "#70f380";
	}
	
	else if(document.location.pathname == "/graph_30days.php"){
		document.getElementById("30days").style.backgroundColor = "#70f380";
	}
	else if(document.location.pathname == "/graph_month.php"){
		document.getElementById("montly").style.backgroundColor = "#70f380";
	}

}
window.onload = link_highlight;
</script>	
	
  </head>

   <body>
  	<?php

     
     //	$strQuery = "SELECT time, zone_temp FROM gsh_sensor_values ORDER BY time";
	//	$strQuery = "SELECT YEAR(time) as Year, MONTHNAME(time) as Month, avg(zone_temp) as Average FROM gsh_sensor_values GROUP BY YEAR(time), MONTH(time)";
		
		$strQuery = "SELECT FROM_UNIXTIME(time, '%Y') as Year, FROM_UNIXTIME(time, '%M') as Month, FROM_UNIXTIME(time, '%d') as Date, avg(zone_temp) as zone_temp_avg, avg(zone_humi) as zone_humi_avg, avg(zone_ammonia) as zone_ammonia_avg, avg(zone_carbon) as zone_carbon_avg, avg(zone_sound) as zone_sound_avg, avg(zone_motion) as zone_motion_avg, avg(ambient_temp) as ambient_temp_avg, avg(ambient_humi) as ambient_humi_avg, avg(cavity_temp) as cavity_temp_avg, avg(cavity_humi) as cavity_humi_avg, avg(fan_temp) as fan_temp_avg FROM gsh_sensor_values WHERE time > UNIX_TIMESTAMP(NOW() - INTERVAL 10 DAY) GROUP BY FROM_UNIXTIME(time, '%d')";

     	// Execute the query, or else return the error message.
		$result = mysqli_query($link, $strQuery);

     	// If the query returns a valid response, prepare the JSON string
     	if ($result) {
        	 // Zone Temperature
        	$arrData1 = array(
        	    "chart" => array(
                  "caption" => "Zone Temperature",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Temperature in F",
                  "theme" => "fint"
              	)
           	);

        	$arrData1["data"] = array();

        	 // Zone humidity
        	$arrData2 = array(
        	    "chart" => array(
                  "caption" => "Zone Humidity",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Humidity in %",
                  "theme" => "fint"
              	)
           	);

        	$arrData2["data"] = array();

        	 // Zone Ammonia
        	$arrData3 = array(
        	    "chart" => array(
                  "caption" => "Zone Ammonia",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Ammonia in PPM",
                  "theme" => "fint"
              	)
           	);

        	$arrData3["data"] = array();
			
        	 // Zone Carbon
        	$arrData4 = array(
        	    "chart" => array(
                  "caption" => "Zone CO2",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "CO2 in PPM",
                  "theme" => "fint"
              	)
           	);

        	$arrData4["data"] = array();
			
        	 // Zone Sound
        	$arrData5 = array(
        	    "chart" => array(
                  "caption" => "Zone Sound",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Sound in Decibel",
                  "theme" => "fint"
              	)
           	);

        	$arrData5["data"] = array();
			
        	 // Zone Motion
        	$arrData6 = array(
        	    "chart" => array(
                  "caption" => "Zone Motion",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Motion",
                  "theme" => "fint"
              	)
           	);

        	$arrData6["data"] = array();
			
        	 // Ambient Temperature
        	$arrData7 = array(
        	    "chart" => array(
                  "caption" => "Ambient Temperature",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Temperature in F",
                  "theme" => "fint"
              	)
           	);

        	$arrData7["data"] = array();
			
        	 // Ambient Humidity
        	$arrData8 = array(
        	    "chart" => array(
                  "caption" => "Ambient Humidity",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Humidity in %",
                  "theme" => "fint"
              	)
           	);

        	$arrData8["data"] = array();
			
        	 // Cavity Temperature
        	$arrData9 = array(
        	    "chart" => array(
                  "caption" => "Cavity Temperature",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Temperature in F",
                  "theme" => "fint"
              	)
           	);

        	$arrData9["data"] = array();
			
        	 // Cavity Humidity
        	$arrData10 = array(
        	    "chart" => array(
                  "caption" => "Cavity Humidity",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Humidity in %",
                  "theme" => "fint"
              	)
           	);

        	$arrData10["data"] = array();
			
        	 // Fan Temperature
        	$arrData11 = array(
        	    "chart" => array(
                  "caption" => "Fan Temperature",
                  "showValues" => "0",
				  "xAxisName"=> "Days",
            	  "yAxisName"=> "Temperature in F",
                  "theme" => "fint"
              	)
           	);

        	$arrData11["data"] = array();
						
	// Push the data into the array
        	while($row = mysqli_fetch_array($result)) {
			
           	array_push($arrData1["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_temp_avg"]
              	)
           	);
			
           	array_push($arrData2["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_humi_avg"]
              	)
           	);
						
           	array_push($arrData3["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_ammonia_avg"]
              	)
           	);
						
           	array_push($arrData4["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_carbon_avg"]
              	)
           	);
						
           	array_push($arrData5["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_sound_avg"]
              	)
           	);
						
           	array_push($arrData6["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["zone_motion_avg"]
              	)
           	);
						
           	array_push($arrData7["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["ambient_temp_avg"]
              	)
           	);
						
           	array_push($arrData8["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["ambient_humi_avg"]
              	)
           	);
						
           	array_push($arrData9["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["cavity_temp_avg"]
              	)
           	);
						
           	array_push($arrData10["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["cavity_humi_avg"]
              	)
           	);
						
           	array_push($arrData11["data"], array(
              	"label" => $row["Date"].' '.$row["Month"].' '.$row["Year"],
				//"label" => $row["Date"],
              	"value" => $row["fan_temp_avg"]
              	)
           	);
						
			
        	}

        	/*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

        	$jsonEncodedData1 = json_encode($arrData1);
        	$columnChart1 = new FusionCharts("area2d", "my1Chart" , 600, 300, "chart-1", "json", $jsonEncodedData1);
        	$columnChart1->render();
			
        	$jsonEncodedData2 = json_encode($arrData2);
        	$columnChart2 = new FusionCharts("area2d", "my2Chart" , 600, 300, "chart-2", "json", $jsonEncodedData2);
        	$columnChart2->render();
			
        	$jsonEncodedData3 = json_encode($arrData3);
        	$columnChart3 = new FusionCharts("area2d", "my3Chart" , 600, 300, "chart-3", "json", $jsonEncodedData3);
        	$columnChart3->render();
									
        	$jsonEncodedData4 = json_encode($arrData4);
        	$columnChart4 = new FusionCharts("area2d", "my4Chart" , 600, 300, "chart-4", "json", $jsonEncodedData4);
        	$columnChart4->render();
									
        	$jsonEncodedData5 = json_encode($arrData5);
        	$columnChart5 = new FusionCharts("area2d", "my5Chart" , 600, 300, "chart-5", "json", $jsonEncodedData5);
        	$columnChart5->render();
									
        	$jsonEncodedData6 = json_encode($arrData6);
        	$columnChart6 = new FusionCharts("area2d", "my6Chart" , 600, 300, "chart-6", "json", $jsonEncodedData6);
        	$columnChart6->render();
									
        	$jsonEncodedData7 = json_encode($arrData7);
        	$columnChart7 = new FusionCharts("area2d", "my7Chart" , 600, 300, "chart-7", "json", $jsonEncodedData7);
        	$columnChart7->render();
									
        	$jsonEncodedData8 = json_encode($arrData8);
        	$columnChart8 = new FusionCharts("area2d", "my8Chart" , 600, 300, "chart-8", "json", $jsonEncodedData8);
        	$columnChart8->render();
									
        	$jsonEncodedData9 = json_encode($arrData9);
        	$columnChart9 = new FusionCharts("area2d", "my9Chart" , 600, 300, "chart-9", "json", $jsonEncodedData9);
        	$columnChart9->render();
									
        	$jsonEncodedData10 = json_encode($arrData10);
        	$columnChart10 = new FusionCharts("area2d", "my10Chart" , 600, 300, "chart-10", "json", $jsonEncodedData10);
        	$columnChart10->render();
									
        	$jsonEncodedData11 = json_encode($arrData11);
        	$columnChart11 = new FusionCharts("area2d", "my11Chart" , 600, 300, "chart-11", "json", $jsonEncodedData11);
        	$columnChart11->render();
												

        	// Close the database connection
     	}

  	?>


<table width="100%" border="1" cellpadding="1">
  <tr>
    
    <td colspan="4" align="center" height="60px"><a href="graphs.php" class="link_buton" id="daily">Daily</a>
		<a href="graph_week.php" class="link_buton" id="weekly">Weekly</a> 
		<a href="graph_30days.php" class="link_buton" id="30days">Last 30 days</a> 
		<a href="graph_month.php" class="link_buton" id="monthly">Monthly</a> </td>
	
    
  </tr>
  
  <tr>
    <td><div id="chart-1"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td><div id="chart-2"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart-3"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td><div id="chart-4"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart-5"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td><div id="chart-6"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart-7"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td><div id="chart-8"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart-9"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td><div id="chart-10"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div id="chart-11"><!-- Fusion Charts will render here--></div></td>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
</table>

  	
   </body>

</html>