<?php
include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if((isset($_GET['idCardNumber']))&&(isset($_GET['licensePlate']))) {
	    
	$idCardNumber = $_GET['idCardNumber'];
	$licensePlate =  str_replace(" ","",$_GET['licensePlate']);
	// $licensePlate = $_GET['licensePlate'];

	$r = mysql_query("SELECT * FROM vin WHERE idCardNumber='".$idCardNumber."'");
	$d = mysql_fetch_assoc($r);

	if(str_replace(" ","",$d['licensePlate'])==$licensePlate){

		echo "
		{
		    \"isSuccess\": true,
		    \"vin\": {
		        \"ID\": \"".$d['ID']."\"
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