<?php

include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$userID = $_GET['userID'];
$Lat  = $_GET['Lat'];
$Long = $_GET['Long'];
$Name = $_GET['Name'];

$sql = "
INSERT INTO `saved_location` (`ID`, `userID`, `name`, `lat`, `long`) 
VALUES (NULL,
'".$userID."',
'".$Name."',
'".$Lat."',
'".$Long."'
)";
mysql_query($sql);


?>