<?php

include('../../app/_mysql.php');
include('../../app/std.php');

$jobPID = $_GET['jobPID'];
$ratingUSER = $_GET['ratingUSER'];

  $sql = "
  UPDATE rating
  SET ratingUSER='".$ratingUSER."'
  WHERE jobPID='".$jobPID."'
  ";
  mysql_query($sql);

$r = mysql_query("SELECT * FROM rating WHERE jobPID='".$jobPID."'");
$d = mysql_fetch_assoc($r);
if ($d['ratingUSER']==0 || $d['ratingUSER']==1) {
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