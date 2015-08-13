<?php
include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if((isset($_GET['email']))&&(isset($_GET['passSHA1']))) {
{	
	$email = $_GET['email'];
	$passSHA1 = $_GET['passSHA1'];

	$r = mysql_query("SELECT * FROM user WHERE Email='".$email."'");
	$d = mysql_fetch_assoc($r);

	if($d['Password']==$passSHA1){

		echo "
		{
		    \"isSuccess\": true,
		    \"user\": {
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