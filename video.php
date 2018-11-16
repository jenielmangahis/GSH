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
<center>
<div>
<br>
<img src="chickens.JPG" />
<h1>Camera will be Interfaced in Phase 2</h1>
</div>
</center>