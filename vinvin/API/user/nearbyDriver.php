<?php
include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$userCurrentLat  = $_GET['currentLat'];
$userCurrentLong = $_GET['currentLong'];

$r = mysql_query("SELECT * FROM vin ORDER BY ID ASC ");
$radius = 0.02;
$outp = "[";
while( $rs = mysql_fetch_assoc($r) ){
	if(
		($userCurrentLat<=($rs["currentLat"]+$radius)&&$userCurrentLong<=($rs["currentLong"]+$radius))AND
		($userCurrentLat<=($rs["currentLat"]+$radius)&&$userCurrentLong>=($rs["currentLong"]-$radius))AND
		($userCurrentLat>=($rs["currentLat"]-$radius)&&$userCurrentLong<=($rs["currentLong"]+$radius))AND
		($userCurrentLat>=($rs["currentLat"]-$radius)&&$userCurrentLong>=($rs["currentLong"]-$radius))
	) //  0.01 ≈ 1.3 km
	{
		if ($outp != "[") {$outp .= ",";}
	    $outp .= '{"ID":"'      . $rs["ID"]        . '",';
	    $outp .= '"currentLat":"'   . $rs["currentLat"]    . '",';
	    $outp .= '"currentLong":"'    . $rs["currentLong"]     . '"}';
	}
}
$outp .="]";

echo($outp);
?>