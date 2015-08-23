<?php
include('../../../app/_mysql.php');
include('../../../app/std.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$email = $_GET['email'];
$passSHA1 = $_GET['passSHA1'];
$tel = $_GET['tel'];
$refID = date('YmdHis')."-".rand(1000,9999);
$OTP=rand(1000,9999);

$sql = "
INSERT INTO user (
	refID,
	Email,
	Password,
	Tel,
	OTP,
	Status
)
VALUES (
	'".$refID."',
	'".$email."',
	'".$passSHA1."',
	'".$tel."',
	'".$OTP."',
	'NoOTP'
)";
mysql_query($sql);
echo mysql_error();


$r = mysql_query("SELECT * FROM user WHERE refID='".$refID."'");
$d = mysql_fetch_assoc($r);
if ($d['refID']) {
  echo "
    {
      \"isSuccess\": true,
      \"errorMessages\": {},
      \"refID\": \"".$d['refID']."\"
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