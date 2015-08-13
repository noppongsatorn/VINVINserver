<?
/* DESCRIPTION
- Receive reportproblem from USER
- Contain to DB
______________________________ */

@header('Content-type: text/html; charset=utf-8');
include('app/_mysql.php');
include('app/std.php');
/*
  $userID = $_POST['userID'];
  $reportproblemtxt = $_POST['reportproblemtxt'];

  $date = date('Y-m-d');
  $time = date('H:i:s');
  echo  $userID, ' ', $vinID, ' ', $star, ' ', $reportproblemtxt;
*/
  $sql = "
	INSERT INTO reportproblem (
    userID,
    reportproblemtxt,
    Date,
    Time
    )
	VALUES (
    '".$_POST['userID']."',
    '".$_POST['reportproblemtxt']."',
    '".date('Y-m-d')."',
    '".date('H:i:s')."'
    )";

mysql_query($sql);
echo mysql_error();



/*

____________________*/

?>