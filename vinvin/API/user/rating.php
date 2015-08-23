<?php

include('../../app/_mysql.php');
include('../../app/std.php');

$jobPID = $_GET['jobPID'];
$ratingVIN = $_GET['ratingVIN'];

  $sql = "
  UPDATE rating
  SET ratingVIN='".$ratingVIN."'
  WHERE jobPID='".$jobPID."'
  ";
  mysql_query($sql);

$r = mysql_query("SELECT * FROM rating WHERE jobPID='".$jobPID."'");
$d = mysql_fetch_assoc($r);
if ($d['ratingVIN']) {
  echo "
    {
      \"isSuccess\": true,
      \"errorMessages\": {},
      \"PID\": \"".$d['PID']."\"
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