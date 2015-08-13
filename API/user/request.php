<?php
/* DESCRIPTION
____________________________________________________________ */

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
$desLat  = $_GET['desLat'];
$desLong = $_GET['desLong'];
$LocationDetail = $_GET['locationDetail'];

$date = date('Y-m-d');
$time = date('H:i:s');
$PID = $_GET['userID']."-".date('YmdHis')."-".rand(1000,9999);

// echo  'userID: '.$userID.'<br>'.
// 'pickLat: '.$pickLat.'<br>'.
// 'pickLong: '.$pickLong.'<br>'.
// 'desLat: '.$desLat.'<br>'.
// 'desLong: '.$desLong.'<br>'.
// 'detail: '.$detail.'<br>'.
// 'Date: ', $date.'<br>'.
// 'Time: ', $time.'<br>'.
// 'PID: ', $PID;


$sql = "
INSERT INTO ridetransaction (
  PID,
  userID,
  pickLat,
  pickLong,
  desLat,
  desLong,
  LocationDetail,
  Status,
  Date,
  Time
  )
VALUES (
  '".$PID."',
  '".$userID."',
  '".$pickLat."',
  '".$pickLong."',
  '".$desLat."',
  '".$desLong."',
  '".$LocationDetail."',
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

// /*___________________ Query _______________________*/
// echo "<br>Nearby vin list";
//           //test
          
          
          


//   $sql_station = mysql_query("SELECT * FROM vin_station");

//   while($result_station = mysql_fetch_assoc($sql_station))
//   {
//     if(
//         ($result_station['lat']<=($_GET['latp']+0.01)&&$result_station['long']<=($_GET['lonp']+0.01))AND
//         ($result_station['lat']<=($_GET['latp']+0.01)&&$result_station['long']>=($_GET['lonp']-0.01))AND
//         ($result_station['lat']>=($_GET['latp']-0.01)&&$result_station['long']<=($_GET['lonp']+0.01))AND
//         ($result_station['lat']>=($_GET['latp']-0.01)&&$result_station['long']>=($_GET['lonp']-0.01))
//       )
//     {
//       echo "<br><br>Station:".$result_station['Station']." Lat:".$result_station['lat']." Long:".$result_station['long'];
//       // _____ While each vin station _____
//       $sql_vin = mysql_query("SELECT * FROM vin WHERE Station='".$result_station['Station']."'");
//       while($result_vin = mysql_fetch_assoc($sql_vin))
//       {
//           echo "<br>Vin device token:".$result_vin['deviceToken'];

//           $devices = new DeviceCollection(array(
//               new Device($result_vin['deviceToken']),
//           ));
//           $pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);
//           $apnsAdapter = new ApnsAdapter(array(
//               'certificate' => 'push/cer/Certificates.pem',));
//           $message = new Message("User:".$_GET['userID']." Time:".date('His'));
//           $push = new Push($apnsAdapter, $devices, $message);
//           $pushManager->add($push);
//           $pushManager->push();
//       }
//       // __________________________________

//     }
//   }





/*___________________
___________________*/

?>