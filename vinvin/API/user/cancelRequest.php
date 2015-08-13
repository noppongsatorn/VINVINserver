<?php
include('../../app/_mysql.php');
include('../../app/std.php');

$jobPID = $_GET['jobPID'];

$rJob = mysql_query("SELECT * FROM ridetransaction WHERE PID='".$jobPID."'");
$dJob = mysql_fetch_assoc($rJob);
if($dJob['Status']=='RequestReceived')
{
	$sql = "
	UPDATE ridetransaction
	SET Status='cancelledByUser' 
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
	    \"errorMessages\": {}
	}
	";
}
else if($dJob['Status']=='DriverDispatched'){
	echo "
	{
	    \"isSuccess\": false,
	    \"errorMessages\": {
	        \"reason\": \"can not cancel because driver already dispatched\"
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