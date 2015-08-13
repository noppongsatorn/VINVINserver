<?php

include('../../app/_mysql.php');
include('../../app/std.php');
// PUSH
// require_once '../../push/vendor/autoload.php';
// use Sly\NotificationPusher\PushManager,
//           Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
//           Sly\NotificationPusher\Collection\DeviceCollection,
//           Sly\NotificationPusher\Model\Device,
//           Sly\NotificationPusher\Model\Message,
//           Sly\NotificationPusher\Model\Push,
//           Sly\NotificationPusher\Model\DeviceInterface
//       ;
/*____________________________________________________________ */

// request.php?userID=0289&pickLat=13.721154&pickLong=100.584564&desLat=13.725921&desLong=100.595669&detail=บ้านเลขที่ 26

$userID = $_GET['userID'];
$pickLat  = $_GET['pickLat'];
$pickLong = $_GET['pickLong'];
$pickName = $_GET['pickName'];
$desLat  = $_GET['desLat'];
$desLong = $_GET['desLong'];
$desName = $_GET['desName'];
$LocationDetail = $_GET['locationDetail'];

$distance = distance($pickLat, $pickLong, $desLat, $desLong, "K");

$date = date('Y-m-d');
$time = date('H:i:s');
$PID = $_GET['userID']."-".date('YmdHis')."-".rand(1000,9999);

$sql = "
INSERT INTO ridetransaction (
  PID,
  userID,
  pickLat,
  pickLong,
  pickName,
  desLat,
  desLong,
  desName,
  LocationDetail,
  distance,
  Status,
  Date,
  Time
  )
VALUES (
  '".$PID."',
  '".$userID."',
  '".$pickLat."',
  '".$pickLong."',
  '".$pickName."',
  '".$desLat."',
  '".$desLong."',
  '".$desName."',
  '".$LocationDetail."',
  '".$distance."',
  'RequestReceived',
  '".$date."',
  '".$time."'
  )";

mysql_query($sql);
// echo mysql_error();



$r = mysql_query("SELECT * FROM ridetransaction WHERE PID='".$PID."'");
$d = mysql_fetch_assoc($r);
if ($d['PID']) {
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




function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}


// echo "Starting\n";

// # Create our worker object.
// $gmworker= new GearmanWorker();

// # Add default server (localhost).
// $gmworker->addServer();

// # Register function "reverse" with the server.
// $gmworker->addFunction("reverse", "reverse_fn");

// # Set the timeout to 5 seconds
// $gmworker->setTimeout(5000);

// echo "Waiting for job...\n";
// while(@$gmworker->work() || $gmworker->returnCode() == GEARMAN_TIMEOUT)
// {
//   if ($gmworker->returnCode() == GEARMAN_TIMEOUT)
//   {
//     # Normally one would want to do something useful here ...
//     echo "Timeout. Waiting for next job...\n";
//     continue;
//   }

//   if ($gmworker->returnCode() != GEARMAN_SUCCESS)
//   {
//     echo "return_code: " . $gmworker->returnCode() . "\n";
//     break;
//   }
// }

// echo "Done\n";

// function reverse_fn($job)
// {
//   return strrev($job->workload());
// }
?>