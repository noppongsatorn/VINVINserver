<?php
include('../../../app/_mysql.php');
include('../../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$refID = $_GET['refID'];
$OTP = $_GET['OTP'];

$r = mysql_query("SELECT * FROM user WHERE refID='".$refID."'");
$d = mysql_fetch_assoc($r);

// Check OTP & Update Status='RegisComplete'
if($d['OTP']==$OTP)
{
    $sql = "
	    UPDATE user
	    SET Status='RegisComplete'
	    WHERE ID='".$d['ID']."'
	    ";
	mysql_query($sql);
	echo "
		{
		    \"isSuccess\": true,
		    \"user\": {
		        \"ID\": \"".$d['ID']."\"
		    }
		}
	";
}
else
{
	echo "
		{
		    \"isSuccess\": false,
		    \"errorMessages\": {}
		}
	";
}
?>