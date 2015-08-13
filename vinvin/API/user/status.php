<?php
include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$jobPID = $_GET['jobPID'];

$rJob = mysql_query("SELECT * FROM ridetransaction WHERE PID='".$jobPID."'");
$dJob = mysql_fetch_assoc($rJob);

if($dJob['Status']=='DriverDispatched'){

	$rVin = mysql_query("SELECT * FROM vin WHERE ID='".$dJob['vinID']."'");
	$dVin = mysql_fetch_assoc($rVin);
	echo "
	{
	    \"complete\": true,
	    \"vin\": {
	        \"name\": \"".$dVin['Name']."\",
	        \"number\": \"".$dVin['Number']."\",
	        \"station\": \"".$dVin['Station']."\",
	        \"model\": \"".$dVin['Model']."\",
	        \"tel\": \"".$dVin['Tel']."\",
	        \"currentLat\": \"".$dVin['currentLat']."\",
	        \"currentLong\": \"".$dVin['currentLong']."\"
	    }
	}
	";
}
else{
	echo "
	{
	    \"complete\": false,
	    \"errorMessages\": {}
	}
	";
}
?>