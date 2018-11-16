
<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>



<?php include('database.php'); ?>
<?php include('header.php'); ?>



<?php

	if (isset($_POST['update'])) {
		$max_temp = $_POST['max_temp'];
		$min_temp = $_POST['min_temp'];
		
		$max_humi = $_POST['max_humi'];
		$min_humi = $_POST['min_humi'];
		
		$max_ammonia = $_POST['max_ammonia'];
		$min_ammonia = $_POST['min_ammonia'];
			
		$max_carbon = $_POST['max_carbon'];
		$min_carbon = $_POST['min_carbon'];
				
		$max_sound = $_POST['max_sound'];
		//$min_sound = $_POST['min_sound'];	
				
		$max_motion = $_POST['max_motion'];
		//$min_motion = $_POST['min_motion'];		
		
	mysqli_query($link, "UPDATE gsh_critical_values SET max_temp='$max_temp', min_temp='$min_temp', max_humi='$max_humi', min_humi='$min_humi', max_ammonia='$max_ammonia', min_ammonia='$min_ammonia', max_carbon='$max_carbon', min_carbon='$min_carbon', max_sound='$max_sound', max_motion='$max_motion' WHERE counter=1");
	$_SESSION['message'] = "Address updated!";  
		$_SESSION['message'] = "Values Entered Successfully"; 
		echo "";
		//header('location: critical_values.php');
		
	}
	
	$results = mysqli_query($link, "SELECT * FROM gsh_critical_values where counter=1");
	$row = mysqli_fetch_array($results)
?>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">

<script src="js/validation.js"></script>
    
</script>
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>


<form name="stmt" method="post">
<h2>Sensor Level Control in Zone</h2>
<table>

<tr>
<td><label>If Zone Temperature Goes below <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_temp" value="<?php echo $row['max_temp']; ?>"  required="required"/> </td>
<td>&deg;F</td>
<td><label>Turn on the Fan upto <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="min_temp" value="<?php echo $row['min_temp']; ?>"  required="required"/> </td>
<td>&deg;F</td>
</tr>

<tr>
<td><label>If Zone Humidity Exceeds <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_humi" value="<?php echo $row['max_humi']; ?>" required="required" /> </td>
<td>%</td>
<td><label>Turn on the Fan upto <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="min_humi" value="<?php echo $row['min_humi']; ?>" required="required" /> </td>
<td>%</td>
</tr>

<tr>
<td><label>If Zone Ammonia Exceeds <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_ammonia" value="<?php echo $row['max_ammonia']; ?>" required="required" /> </td>
<td>PPM</td>
<td><label>Turn on the Fan upto <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="min_ammonia" value="<?php echo $row['min_ammonia']; ?>" required="required" /> </td>
<td>PPM</td>
</tr>

<tr>
<td><label>If Zone CO2 Exceeds <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_carbon" value="<?php echo $row['max_carbon']; ?>" required="required" /> </td>
<td>PPM</td>
<td><label>Turn on the Fan upto <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="min_carbon" value="<?php echo $row['min_carbon']; ?>" required="required" /> </td>
<td>PPM</td>
</tr>

<tr>
<td><label>If Zone Sound Exceeds <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_sound" value="<?php echo $row['max_sound']; ?>" required="required" /> </td>
<td>Decibels&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td><label> </label></td>
<td></td>
<td> </td>
</tr>

<tr>
<td><label>If Zone Motion Exceeds <span style="color:#F00;">*</span> :</label></td>
<td><input type="text" name="max_motion" value="<?php echo $row['max_motion']; ?>" required="required" /> </td>
<td></td>
<td></td>
<td> </td>
<td></td>
</tr>

<tr>
<td></td>
<td><input type="submit" class="btn" name="update" value="Submit" onClick="return validateForm()" /></td>
</tr>

</table><br><br>
<span class='notice'>Email will be sent whenever any sensor exceeds its critical limit</span>
</form>
</body>