<?php

include('database.php');

		$fan_status = $_POST['val'];
		$override = $_POST['override'];
		$strQuery = "SELECT * FROM gsh_sensor_values ORDER BY id DESC LIMIT 1";

     	// Execute the query, or else return the error message.
		$result = mysqli_query($link, $strQuery);
		$row = mysqli_fetch_row($result);
		foreach($row as $a)
    		echo $a.",";
		
		mysqli_query($link, "UPDATE gsh_fan_control SET fan_status='$fan_status', override='$override' WHERE status_id=1");

?>