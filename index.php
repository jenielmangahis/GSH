<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<?php include('header.php'); ?>
<?php include('database.php'); ?><head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="http://bernii.github.io/gauge.js/dist/gauge.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
<style>
.td_values{border: #cbd2d8 2px solid; box-shadow: inset 0 0 0 -1px red; font-size:15px; padding:5px; background:#A5D056; font-family: 'Orbitron';}
</style>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<?php
$strQuery2 = "SELECT * FROM gsh_fan_control where status_id=1";
$result2 = mysqli_query($link, $strQuery2);
$row2 = mysqli_fetch_array($result2);
// echo $row2['fan_status'];
?>


<div>
<!--<center><img src="https://circuitdigest.com/sites/default/files/GSH_logo.png" width="500px"/></center>-->

<h2></h2>

<table width="100%" cellspacing="2" cellpadding="1">
	<tr><center><td class="msg"  colspan="4"></td></center></tr>
    <tr><center><td colspan="4"><br><br></td></center></tr>
  <tr>
  	<td width="60%">
    
    <table width="100%" cellpadding="1">
      <tr>
        <td align="center"><canvas id="z_temp_gauge"></canvas></td>
        <td align="center"><canvas id="z_humi_gauge"></canvas></td>
      </tr>
      <tr>
        <td align="center">Zone Temperature:&nbsp;<span id="ztemp" style="color:#C33; font-size:20px;"></span>&nbsp;&deg;F</td>
        <td align="center">Zone Humidity:&nbsp;<span id="zhumi" style="color:#C33; font-size:20px;"></span>&nbsp;PPM</td>
      </tr><tr height="15px"></tr>
      <tr>
        <td align="center"><canvas id="z_co2_gauge"></canvas></td>
        <td align="center"><canvas id="z_amoni_gauge"></canvas></td>
      </tr>
      <tr>
        <td align="center">Zone CO2 Level:&nbsp;<span id="zco2" style="color:#C33; font-size:20px;"></span>&nbsp;PPM</td>
        <td align="center">Zone Ammonia:&nbsp;<span id="zamoni" style="color:#C33; font-size:20px;"></span>&nbsp;PPM</td>
      </tr><tr height="15px"></tr>
      <tr>
        <td align="center"><canvas id="z_sound_gauge"></canvas></td>
        <td align="center"><canvas id="z_motion_gauge"></canvas></td>
      </tr>
      <tr>
        <td align="center">Zone Sound Level:&nbsp;<span id="zsound" style="color:#C33; font-size:20px;"></span>&nbsp;Decibels</td>
        <td align="center">Zone Motion Level:&nbsp;<span id="zmotion" style="color:#C33; font-size:20px;"></span>&nbsp;per 10 Seconds</td>
      </tr>
    </table>
    </td>


    <td valign="top" width="40%">
	<table width="100%" cellpadding="1">
	<tr><td width="50%"><b>Ambient Temperature:</td><td><div style="width:50px; display: inline-block;" id="amtemp" class="td_values"></div>&nbsp;&nbsp;&deg;F</td></tr>
	<tr><td><b>Ambient Humidity:</td><td><div style="width:50px; display: inline-block;" id="amhumi" class="td_values"></div>&nbsp;&nbsp;%</td></tr>
	<tr><td><b>Cavity Temperature:</td><td><div style="width:50px; display: inline-block;" id="cavtemp" class="td_values"></div>&nbsp;&nbsp;&deg;F</td></tr>
	<tr><td><b>Cavity Humidity:</td><td><div style="width:50px; display: inline-block;" id="cavhumi" class="td_values"></div>&nbsp;&nbsp;%</td></tr>
	<tr><td><b>Fan Temperature:</td><td><div style="width:50px; display: inline-block;" id="fantemp" class="td_values"></div>&nbsp;&nbsp;&deg;F</td></tr>
	
	<tr height="20%"><td> </td><td> </td></tr> 
	
	<tr><td><span style="color:#930; font-size:20px;"><b>Turn On Manual Control to the Fan*</b></span></td><td>  <input type="checkbox" name="override" class="override"></td></tr>
	<tr><td><span class="notice">*This setting should be off to work the Fan automatically</span></td><td>  <input type = "radio" value = "ON" name="fan" <?php echo ($row2['fan_status']=='ON')?'checked':'' ?> />ON&nbsp;&nbsp;<input type = "radio" value = "OFF" name="fan" <?php echo ($row2['fan_status']=='OFF')?'checked':'' ?> />OFF</td></tr>
	</table>
	</td>
	
	</tr>
</table>



<br><br><br><span>(Updating every 2 seconds)</span>



</div>

<script>
// zone temperature
var opts1 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,50,100, 150],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#F03E3E", min: 0, max: 50},
    {strokeStyle: "#FFDD00", min: 50, max: 100},
    {strokeStyle: "#30B32D", min: 100, max: 150},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target1 = document.getElementById('z_temp_gauge'); // your canvas element
var gauge1 = new Gauge(target1).setOptions(opts1); // create sexy gauge!
gauge1.maxValue = 150; // set max gauge value
gauge1.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge1.animationSpeed = 32; // set animation speed (32 is default value)

// zone humidity
var opts2 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,33,66, 100],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#30B32D", min: 0, max: 33},
    {strokeStyle: "#FFDD00", min: 33, max: 66},
    {strokeStyle: "#F03E3E", min: 66, max: 100},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target2 = document.getElementById('z_humi_gauge'); // your canvas element
var gauge2 = new Gauge(target2).setOptions(opts2); // create sexy gauge!
gauge2.maxValue = 100; // set max gauge value
gauge2.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge2.animationSpeed = 32; // set animation speed (32 is default value)

// zone co2
var opts3 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,1650,3300, 5000],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#30B32D", min: 0, max: 1650},
    {strokeStyle: "#FFDD00", min: 1650, max: 3300},
    {strokeStyle: "#F03E3E", min: 3300, max: 5000},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target3 = document.getElementById('z_co2_gauge'); // your canvas element
var gauge3 = new Gauge(target3).setOptions(opts3); // create sexy gauge!
gauge3.maxValue = 5000; // set max gauge value
gauge3.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge3.animationSpeed = 32; // set animation speed (32 is default value)

// zone amonia
var opts4 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,17,33, 50],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#30B32D", min: 0, max: 17},
    {strokeStyle: "#FFDD00", min: 17, max: 33},
    {strokeStyle: "#F03E3E", min: 33, max: 50},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target4 = document.getElementById('z_amoni_gauge'); // your canvas element
var gauge4 = new Gauge(target4).setOptions(opts4); // create sexy gauge!
gauge4.maxValue = 50; // set max gauge value
gauge4.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge4.animationSpeed = 32; // set animation speed (32 is default value)

// zone sound
var opts5 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,33,66, 100],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#30B32D", min: 0, max: 33},
    {strokeStyle: "#FFDD00", min: 33, max: 66},
    {strokeStyle: "#F03E3E", min: 66, max: 100},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target5 = document.getElementById('z_sound_gauge'); // your canvas element
var gauge5 = new Gauge(target5).setOptions(opts5); // create sexy gauge!
gauge5.maxValue = 100; // set max gauge value
gauge5.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge5.animationSpeed = 32; // set animation speed (32 is default value)

// zone motion
var opts6 = {
  angle: -0.2, // The span of the gauge arc
  lineWidth: 0.2, // The line thickness
  radiusScale: 1, // Relative radius
  pointer: {
  length: 0.6, // // Relative to gauge radius
  strokeWidth: 0.035, // The thickness
  color: '#000000', // Fill color
  },
	fontSize:24,
staticLabels: {
  font: "12px sans-serif",  // Specifies font
  labels: [0,5,10, 15],  // Print labels at these values
  color: "#000000",  // Optional: Label text color
  fractionDigits: 0  // Optional: Numerical precision. 0=round off.
},
  staticZones: [
    {strokeStyle: "#30B32D", min: 0, max: 5},
    {strokeStyle: "#FFDD00", min: 5, max: 10},
    {strokeStyle: "#F03E3E", min: 10, max: 15},
  ],

  limitMax: false,     // If false, max value increases automatically if value > maxValue
  limitMin: false,     // If true, the min value of the gauge will be fixed
  colorStart: '#6FADCF',   // Colors
  colorStop: '#8FC0DA',    // just experiment with them
  strokeColor: '#E0E0E0',  // to see which ones work best for you
  generateGradient: true,
  highDpiSupport: true,     // High resolution support
};
var target6 = document.getElementById('z_motion_gauge'); // your canvas element
var gauge6 = new Gauge(target6).setOptions(opts6); // create sexy gauge!
gauge6.maxValue = 15; // set max gauge value
gauge6.setMinValue(0);  // Prefer setter over gauge.minValue = 0
gauge6.animationSpeed = 32; // set animation speed (32 is default value)



setInterval(
  function()
  {	
		var r =$('input[name=fan]:checked').val();
		if($('.override').is(':checked')){ 
			var s='1';
			$('input[name=fan]').prop('disabled', false);
			} else { 
			var s='0'; $('input[name=fan]').prop('disabled', 'disabled');
			}
			
$.ajax({
				 type:    'POST',
                 url:     'ajax.php',
                 data: { val : r, override : s },
                 cache:   false,
                 success: function(data){
                     var sensor_values = data.split(",");
					// alert(data);
               //  }
      //  });
		
  		var ts = Math.round((new Date()).getTime() / 1000); 
		if((ts-sensor_values[1])>60){$(".msg").html("<span style='color:#F00'>Data is not updating... Internet Connectivity Issue...</span>");} 
			else {$(".msg").text("Updating in Real Time...");}
   // $.getJSON('/show_values',function(data) {
	//	var sensor_values = data.result.split(",");
      	$("#ztemp").text(sensor_values[2]);
		$("#zhumi").text(sensor_values[3]);
		$("#zamoni").text(sensor_values[4]);
		$("#zco2").text(sensor_values[5]);
		$("#zsound").text(sensor_values[6]);
		$("#zmotion").text(sensor_values[7]);
		$("#amtemp").text(sensor_values[8]);
		$("#amhumi").text(sensor_values[9]);
		$("#cavtemp").text(sensor_values[10]);
		$("#cavhumi").text(sensor_values[11]);
		$("#fantemp").text(sensor_values[12]);
	 // $("#humi").text(data.var2);
	//  document.write(data);
		//alert(data.sensor_values);
		gauge1.set(sensor_values[2]);
		gauge2.set(sensor_values[3]);
		gauge3.set(sensor_values[5]);
		gauge4.set(sensor_values[4]);
		gauge5.set(sensor_values[6]);
		gauge6.set(sensor_values[7]);
		}
	 });

  },
500);

</script>
