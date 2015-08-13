<?php
include('../../../app/_mysql.php');
include('../../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


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
$outp = "[";
while( $rs = mysql_fetch_assoc($r) ){
	if(
		($currentLat<=($rs["pickLat"]+0.02)&&$currentLong<=($rs["pickLong"]+0.02))AND
		($currentLat<=($rs["pickLat"]+0.02)&&$currentLong>=($rs["pickLong"]-0.02))AND
		($currentLat>=($rs["pickLat"]-0.02)&&$currentLong<=($rs["pickLong"]+0.02))AND
		($currentLat>=($rs["pickLat"]-0.02)&&$currentLong>=($rs["pickLong"]-0.02))
	) //  0.01 ≈ 1.3 km
	{
	    if ($outp != "[") {$outp .= ",";}
	    $outp .= '{"PID":"'      . $rs["PID"]        . '",';
	    $outp .= '"pickLat":"'   . $rs["pickLat"]    . '",';
	    $outp .= '"pickLong":"'  . $rs["pickLong"]   . '",';
	    $outp .= '"desLat":"'    . $rs["desLat"]     . '",';
	    $outp .= '"desLong":"'   . $rs["desLong"]    . '",';
	    $outp .= '"userID":"'    . $rs["userID"]     . '",';
	    $outp .= '"Status":"'    . $rs["Status"]     . '"}'; 
	}
}
$outp .="]";


echo($outp);

// // read file
// $data = file_get_contents('http://www.w3schools.com/website/Customers_MYSQL.php');
// $json = json_decode($data, true);

// echo $json[0]['Name'];

// // // manipulate data
// // $json['users'][] = $_GET['user'];

// // // write out file
// // $dataNew = json_encode($json);
// // file_put_contents('data.json', $dataNew);

?>