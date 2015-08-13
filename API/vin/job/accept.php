<?php
include('../../../app/_mysql.php');
include('../../../app/std.php');

$vinID = $_GET['vinID'];
$jobPID  = $_GET['jobPID'];

$rJob = mysql_query("SELECT * FROM ridetransaction WHERE PID='".$jobPID."'");
$dJob = mysql_fetch_assoc($rJob);
if($dJob['Status']=='RequestReceived')
{
	$sql = "
	UPDATE ridetransaction
	SET vinID='".$vinID."',
	Status='DriverDispatched' 
	WHERE PID='".$jobPID."'
	";
	mysql_query($sql);

	// Send push to user
	$rUser = mysql_query("SELECT * FROM user WHERE ID='".$dJob['userID']."'");
	$dUser = mysql_fetch_assoc($rUser);
	//echo "<br>deviceToken=".$dUser['deviceToken'];
	echo "
	{
	    \"isSuccess\": true,
	    \"errorMessages\": {},
	    \"job\": {
	        \"pickLat\": \"".$dJob['pickLat']."\",
	        \"pickLong\": \"".$dJob['pickLong']."\",
	        \"desLat\": \"".$dJob['desLat']."\",
	        \"desLong\": \"".$dJob['desLong']."\",
	        \"locationDetail\": \"".$dJob['locationDetail']."\"
	    },
	    \"user\": {
	        \"tel\": \"".$dUser['Tel']."\"
	    }
	}
	";
}
else if($dJob['Status']=='DriverDispatched'){
	echo "
	{
	    \"isSuccess\": false,
	    \"errorMessages\": {
	        \"reason\": \"another vin already accepted\"
	    }
	}
	";
}
else{
	echo "
	{
	    \"isSuccess\": false,
	    \"errorMessages\": {}
	}
	";
}

?>