<?
/* 
ต้อง check ก่อนว่า เงินพอไหม ก่อนที่
______________________________ */

include('app/_mysql.php');
include('app/std.php');
// PUSH
require_once 'push/vendor/autoload.php';
use Sly\NotificationPusher\PushManager,
          Sly\NotificationPusher\Adapter\Apns as ApnsAdapter,
          Sly\NotificationPusher\Collection\DeviceCollection,
          Sly\NotificationPusher\Model\Device,
          Sly\NotificationPusher\Model\Message,
          Sly\NotificationPusher\Model\Push
      ;
/*____________________________________________________________ */

  $PID = $_POST['PID'];
  $vinID  = $_POST['vinID'];
  echo  'PID:', $PID, ' vinID:', $vinID;


// Check Available

  $sql_ridetransaction = mysql_query("SELECT * FROM ridetransaction WHERE PID='".$_POST['PID']."'");
  $result_ridetransaction = mysql_fetch_assoc($sql_ridetransaction);
  //echo "<br>    Status=".$result_ridetransaction['Status'];

  if($result_ridetransaction['Status']=='RequestReceived')
  {
    $sql = "
    UPDATE ridetransaction
    SET vinID='".$_POST['vinID']."', Status='DriverDispatched'
    WHERE PID='".$_POST['PID']."'
    ";

    // Send push to user
    $sql_user = mysql_query("SELECT * FROM user WHERE ID='".$result_ridetransaction['userID']."'");
    $result_user = mysql_fetch_assoc($sql_user);
    echo "<br>    deviceToken=".$result_user['deviceToken'];

    sendPush($result_user['deviceToken']);

  }

mysql_query($sql);
echo mysql_error();

/** Send PUSH to USER
# To send
    PID,
    vin.ID
** Send PUSH to delete this request to other VIN
# To send
    PID
____________________*/

function sendPush($token) {
$pushManager = new PushManager(PushManager::ENVIRONMENT_DEV);
$apnsAdapter = new ApnsAdapter(array(
    'certificate' => 'push/cer/Certificates.pem',));
$devices = new DeviceCollection(array(
    new Device($token),
    //new Device('1dbf2cf3bce3a40c6f4e8a19b9ce127553d0409b114c26e2dfd90a27720e66ed') //Nop iPhone as user
    // ...
));
// Then, create the push skel.
$message = new Message('วินมอเตอร์ไซค์ กำลังมารับ');
$push = new Push($apnsAdapter, $devices, $message);
$pushManager->add($push);
$pushManager->push();

}
?>