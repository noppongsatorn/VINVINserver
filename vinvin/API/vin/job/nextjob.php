<?php
include('../../../app/_mysql.php');
include('../../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$previousJobPID = $_GET['previousJobPID'];
$vinID = $_GET['vinID'];
$currentLat  = $_GET['currentLat'];
$currentLong = $_GET['currentLong'];

$sql = "
UPDATE vin
SET currentLat='".$currentLat."',
	currentLong='".$currentLong."' 
WHERE ID='".$vinID."'
";
mysql_query($sql);

$r = mysql_query("SELECT * FROM ridetransaction WHERE Status='RequestReceived' ORDER BY Time ASC ");

// $i;
// for($i=0; $rs = mysql_fetch_assoc($r);$i++ ){
// 	if($previousJobPID == $rs["PID"])
// 	{
// 		break;
// 	}
// }
// echo $i;

$radius = 0.02;
while($rs = mysql_fetch_assoc($r)){
	if(
		($currentLat<=($rs["pickLat"]+$radius)&&$currentLong<=($rs["pickLong"]+$radius))AND
		($currentLat<=($rs["pickLat"]+$radius)&&$currentLong>=($rs["pickLong"]-$radius))AND
		($currentLat>=($rs["pickLat"]-$radius)&&$currentLong<=($rs["pickLong"]+$radius))AND
		($currentLat>=($rs["pickLat"]-$radius)&&$currentLong>=($rs["pickLong"]-$radius))
	) //  0.01 ≈ 1.3 km
	{
		if($previousJobPID == $rs["PID"])
		{

		}
		else
		{
		    $outp .= '{"PID":"'      . $rs["PID"]        . '",';
		    $outp .= '"pickLat":"'   . $rs["pickLat"]    . '",';
		    $outp .= '"pickLong":"'  . $rs["pickLong"]   . '",';
		    $outp .= '"pickName":"'  . $rs["pickName"]   . '",';
		    $outp .= '"desLat":"'    . $rs["desLat"]     . '",';
		    $outp .= '"desLong":"'   . $rs["desLong"]    . '",';
		    $outp .= '"desName":"'   . $rs["desName"]    . '",';
		    $outp .= '"locationDetail":"'   . $rs["locationDetail"]    . '",';
		    $outp .= '"distance":"'   . $rs["distance"]    . '",';
		    $outp .= '"userID":"'    . $rs["userID"]     . '",';
		    $outp .= '"Status":"'    . $rs["Status"]     . '"}'; 
			break;
		}

	}
}

echo($outp);

?>