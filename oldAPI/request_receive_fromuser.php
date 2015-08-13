<?
/* DESCRIPTION
- Receive request from USER
- Send PUSH to nearby VIN
____________________________________________________________ */

include('app/_mysql.php');
include('app/std.php');
// PUSH
require_once 'push/vendor/autoload.php';
use Sly\NotificationPusher\PushManager,
          Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
          Sly\NotificationPusher\Collection\DeviceCollection,
          Sly\NotificationPusher\Model\Device,
          Sly\NotificationPusher\Model\Message,
          Sly\NotificationPusher\Model\Push,
          Sly\NotificationPusher\Model\DeviceInterface
      ;
/*____________________________________________________________ */


/*
  $userID = $_POST['userID'];
  $latp  = $_POST['latp'];
  $lonp = $_POST['lonp'];
  $latd  = $_POST['latd'];
  $lond = $_POST['lond'];
  $lond = $_POST['locationDetail'];

  $date = date('Y-m-d');
  $time = date('H:i:s');
  $PID = $_POST['userID'].date('YmdHis');
*/
  echo  $_POST['userID'], ' ', $_POST['latp'], ' ', $_POST['lonp'], ' ', $_POST['latd'], ' ', $_POST['lond'], ' ', $_POST['LocationDetail'], ' Date:', date('Y-m-d'), ' Time:', date('H:i:s'), '<br>PID:', $_POST['userID'].date('YmdHis');;

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
    '".$_POST['userID'].date('YmdHis')."',
    '".$_POST['userID']."',
    '".$_POST['latp']."',
    '".$_POST['lonp']."',
    '".$_POST['latd']."',
    '".$_POST['lond']."',
    '".$_POST['LocationDetail']."',
    'RequestReceived',
    '".date('Y-m-d')."',
    '".date('H:i:s')."'
    )";

mysql_query($sql);
echo mysql_error();



/*___________________ Query _______________________*/
echo "<br>Nearby vin list";
          //test
          
          
          


  $sql_station = mysql_query("SELECT * FROM vin_station");

  while($result_station = mysql_fetch_assoc($sql_station))
  {
    if(
        ($result_station['lat']<=($_POST['latp']+0.01)&&$result_station['long']<=($_POST['lonp']+0.01))AND
        ($result_station['lat']<=($_POST['latp']+0.01)&&$result_station['long']>=($_POST['lonp']-0.01))AND
        ($result_station['lat']>=($_POST['latp']-0.01)&&$result_station['long']<=($_POST['lonp']+0.01))AND
        ($result_station['lat']>=($_POST['latp']-0.01)&&$result_station['long']>=($_POST['lonp']-0.01))
      )
    {
      echo "<br><br>Station:".$result_station['Station']." Lat:".$result_station['lat']." Long:".$result_station['long'];
      // _____ While each vin station _____
      $sql_vin = mysql_query("SELECT * FROM vin WHERE Station='".$result_station['Station']."'");
      while($result_vin = mysql_fetch_assoc($sql_vin))
      {
          echo "<br>Vin device token:".$result_vin['deviceToken'];

          $devices = new DeviceCollection(array(
              new Device($result_vin['deviceToken']),
          ));
          $pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);
          $apnsAdapter = new ApnsAdapter(array(
              'certificate' => 'push/cer/Certificates.pem',));
          $message = new Message("User:".$_POST['userID']." Time:".date('His'));
          $push = new Push($apnsAdapter, $devices, $message);
          $pushManager->add($push);
          $pushManager->push();
      }
      // __________________________________

    }
  }





/*___________________
# To send to VIN
    PID,
    pickLat,
    pickLong,
    desLat,
    desLong
# To get back
    PID,
    vin.ID
___________________*/

?>