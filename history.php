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

if(isset($_POST['export'])) {
   // session_destroy(); // Or other session-unsetting logic
  //  echo "maisn";
}
//session_start();
include('header.php');

if( isset($_POST['export']) && $_POST['to'] == '' ) {$_SESSION['to'] = date('Y-m-d');} 
if( isset($_POST['export']) && $_POST['from'] == '' ) {$_SESSION['from'] = "2018-01-01";}

if( isset($_POST['to']) &&  $_POST['to'] != ''){  $_SESSION['to'] = $_POST['to'];} 

		if( isset($_POST['from']) &&  $_POST['from'] != '' ){  $_SESSION['from'] = $_POST['from'];} 
		
		//echo time();
		//echo strtotime("2018-03-07");
?>

<?php
    require_once 'Paginator.class.php';
 
    $conn       = new mysqli( "localhost", "gsh_user", "GSH_agrieos%))@", "gsh_database" );
 
    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 10;
    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    //$query      = "SELECT * FROM gsh_sensor_values";
	$from = strtotime($_SESSION['from']);
	$to = strtotime($_SESSION['to']) + 86400;
	
	$query      = "SELECT * FROM gsh_sensor_values where time >= '$from' AND time <=  '$to' order by time desc";
 
    $Paginator  = new Paginator( $conn, $query );
 
    $results    = $Paginator->getData( $page, $limit );
?>



<!DOCTYPE html>
    <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				<link rel="stylesheet" type="text/css" href="css/style.css">
          <link rel="stylesheet" type="text/css" media="all"
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css"    />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
      <script type="text/javascript" language="javascript">
            jQuery(function() {
                jQuery( "#from" ).datepicker({
                  defaultDate: "+1w",
                  changeMonth: true,
				  changeYear: true,
                  numberOfMonths: 1,
                  dateFormat: "yy-mm-dd",
                  onClose: function( selectedDate ) {
                    $( "#to" ).datepicker( "option", "minDate", selectedDate );
                  }
                });
                jQuery( "#to" ).datepicker({
                  defaultDate: "+1w",
                  changeMonth: true,
				  changeYear: true,
                  numberOfMonths: 1,
                  dateFormat: "yy-mm-dd",
                  onClose: function( selectedDate ) {
                    jQuery( "#from" ).datepicker( "option", "maxDate", selectedDate );
                  }
                });
            });
			
			function ClearFields() {
				document.getElementById("from").value = "";
				document.getElementById("to").value = "";
			}
</script>
        <title>AGRIEOS Data Logging</title>

    </head>

    <body style="margin: 8px;">
        <div class="container" style="width:100%">
                <div class="col-md-10 col-md-offset-1">
                <h1>All Sensor values</h1>
                  
<form method="post" action="history.php"><br>
<b>Date Range:</b> <label style="color:#FFF;" for="from">From</label>
From:<input type="text" id="from" name="from" value="<?php  echo $_SESSION['from'] ?>" />
<label style="color:#FFF;" for="to" >to</label>
To:<input type="text" id="to" name="to" value="<?php  echo $_SESSION['to'] ?>" />
<input name="export" type="submit" value="submit" /> <button type="button" name="clear" onClick="ClearFields();">Clear</button>
</form>
                <table class="table table-striped table-condensed table-bordered table-rounded">
                        <thead>
                                <tr>
                                <th >Time</th>
                                <th >Zone Temp</th>
                                <th >Zone Humi</th>
                                <th >Zone Ammonia</th>
                                <th >Zone CO2</th>
                                <th >Zone Sound</th>
                                <th >Zone Motion</th>
                                <th >Ambient Temp</th>
                                <th >Ambient Humi</th>
                                <th >Cavity Temp</th>
                                <th >Cavity Humi</th>
                                <th >Fan Temp</th>
                        </tr>
                        <?php 
//echo count( $results->data );
if(count( $results->data ) == 0) { ?> <tr><td colspan=13>No Records found</td> </tr> <?php  }  else { 
for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
        <tr>
                <td><?php echo date('Y-m-d H:i:s', $results->data[$i]['time']-14400); ?></td>  <!--Florida time GMT-4 -->
                <td><?php echo $results->data[$i]['zone_temp']; ?></td>
                <td><?php echo $results->data[$i]['zone_humi']; ?></td>
                <td><?php echo $results->data[$i]['zone_ammonia']; ?></td>
                <td><?php echo $results->data[$i]['zone_carbon']; ?></td>
                <td><?php echo $results->data[$i]['zone_sound']; ?></td>
                <td><?php echo $results->data[$i]['zone_motion']; ?></td>
                <td><?php echo $results->data[$i]['ambient_temp']; ?></td>
                <td><?php echo $results->data[$i]['ambient_humi']; ?></td>
                <td><?php echo $results->data[$i]['cavity_temp']; ?></td>
                <td><?php echo $results->data[$i]['cavity_humi']; ?></td>
                <td><?php echo $results->data[$i]['fan_temp']; ?></td>
        </tr>
<?php endfor; } ?>
                        </thead>
                        <tbody></tbody>
                </table><?php echo $Paginator->createLinks( $links, 'pagination pagination-sm' ); ?> 
                </div>
        </div>
        
        </body>
</html>





