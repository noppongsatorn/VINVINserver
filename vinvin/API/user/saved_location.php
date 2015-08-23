<?php

include('../../app/_mysql.php');
include('../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$userID = $_GET['userID'];


$r = mysql_query("SELECT * FROM saved_location WHERE userID='".$userID."' ORDER BY ID ASC ");


$outp = "[";
while( $rs = mysql_fetch_assoc($r) ){
      if ($outp != "[") {$outp .= ",";}
      $outp .= '{"name":"'   . $rs["name"]     . '",';
      $outp .= '"lat":"'     . $rs["lat"]      . '",';
      $outp .= '"long":"'    . $rs["long"]     . '"}'; 
}
$outp .="]";

echo($outp);
?>