{"vin":[
    {"Name":"Bird Drib", "Tel":"0811111111", "Number":"7", "Model":"Honda Wave 110i"}
]}


<?
include('app/_mysql.php');
//include('app/std.php');

  $vinID = '1';

  $r = mysql_query("SELECT * FROM vin WHERE ID=".$vinID);
  $d = mysql_fetch_assoc($r);


echo mysql_error();

echo "<br>";
echo "
{\"vin\":[
    {\"Name\":\"".$d['Name']."\", \"Tel\":\"".$d['Tel']."\", \"Number\":\"".$d['Number']."\", \"Model\":\"".$d['Model']."\"}
]}

";
?>