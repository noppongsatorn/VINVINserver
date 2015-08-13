<?
/* DESCRIPTION
- Return JSON by request VIN info (from USER)
______________________________ */

include('app/_mysql.php');
include('app/std.php');

  //$vinID = $_POST['vinID'];
  //echo  'vinID:', $vinID, '<br>';

  $r = mysql_query("SELECT * FROM vin WHERE ID=".$_POST['vinID']);
  $d = mysql_fetch_assoc($r);

  echo "
  {\"vin\":[
      {\"Name\":\"".$d['Name']."\", \"Tel\":\"".$d['Tel']."\", \"Number\":\"".$d['Number']."\", \"Model\":\"".$d['Model']."\"}
  ]}

  ";

//echo mysql_error();


?>