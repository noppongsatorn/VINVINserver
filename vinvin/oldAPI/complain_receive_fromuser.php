<?
/* DESCRIPTION
- Receive complain from USER
- Contain to DB
______________________________ */

@header('Content-type: text/html; charset=utf-8');
include('app/_mysql.php');
include('app/std.php');
/*
  $userID = $_POST['userID'];
  $vinID = $_POST['vinID'];
  $star  = $_POST['star'];
  $complaintxt = $_POST['complaintxt'];

  $date = date('Y-m-d');
  $time = date('H:i:s');
  echo  $userID, ' ', $vinID, ' ', $star, ' ', $complaintxt;
*/
  $sql = "
	INSERT INTO complain (
    userID,
    vinID,
    impolite,
    recklessly,
    noHelmet,
    overCharged,
    complaintxt,
    Date,
    Time
    )
	VALUES (
    '".$_POST['userID']."',
    '".$_POST['vinID']."',
    '".$_POST['impolite']."',
    '".$_POST['recklessly']."',
    '".$_POST['noHelmet']."',
    '".$_POST['overCharged']."',
    '".$_POST['complaintxt']."',
    '".date('Y-m-d')."',
    '".date('H:i:s')."'
    )";

mysql_query($sql);
echo mysql_error();



/*

____________________*/

?>