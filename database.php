<?php
$link = mysqli_connect("localhost", "root", ""); //$link = mysqli_connect("localhost", "gsh_user", "GSH_agrieos%))@");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql0    = "CREATE DATABASE IF NOT EXISTS gsh_database";
$retval = mysqli_query($link, $sql0);
if (!$retval) {
    die('DATABASE CREATION FAILED\n: ' . mysql_error());
}

mysqli_select_db($link, "gsh_database");


$sql = "CREATE TABLE IF NOT EXISTS gsh_critical_values(
  counter INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  max_temp VARCHAR(150),
  min_temp VARCHAR(255),
  max_humi VARCHAR(255),
  min_humi VARCHAR(75),
  max_ammonia VARCHAR(255),
  min_ammonia VARCHAR(255),
  max_carbon VARCHAR(255),
  min_carbon VARCHAR(255),
  max_sound VARCHAR(255), 
  min_sound VARCHAR(255),  
  max_motion VARCHAR(255),  
  min_motion VARCHAR(255)
)";

if(mysqli_query($link, $sql)){
  //  echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql00="INSERT IGNORE INTO gsh_critical_values (counter) VALUES ('1')";
mysqli_query($link, $sql00);


$sql1 = "CREATE TABLE IF NOT EXISTS gsh_sensor_values(
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  time VARCHAR(255),
  zone_temp VARCHAR(150),
  zone_humi VARCHAR(255),
  zone_ammonia VARCHAR(255),
  zone_carbon VARCHAR(255),
  zone_sound VARCHAR(255),  
  zone_motion VARCHAR(255),
  ambient_temp VARCHAR(255),
  ambient_humi VARCHAR(255),
  cavity_temp VARCHAR(255),
  cavity_humi VARCHAR(255),  
  fan_temp VARCHAR(255)
)";

if(mysqli_query($link, $sql1)){
  //  echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql2 = "CREATE TABLE IF NOT EXISTS gsh_fan_control(
  status_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  fan_status VARCHAR(255),
  override VARCHAR(255)
)";

if(mysqli_query($link, $sql2)){
  //  echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql20="INSERT IGNORE INTO gsh_fan_control (status_id) VALUES ('1')";
mysqli_query($link, $sql20);

$sql3 = "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if(mysqli_query($link, $sql3)){
  //  echo "Table created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql30="INSERT IGNORE INTO users (username) VALUES ('admin')";
mysqli_query($link, $sql30);

/*$sql2 = "INSERT INTO gsh_sensor_values (time, zone_temp, zone_humi, zone_ammonia)
VALUES (now() - interval 5 day, '11', '3','4')";

if(mysqli_query($link, $sql2)){
    echo "row created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}*/



?>