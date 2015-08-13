<?
/* 
______________________________ */

include('app/_mysql.php');
include('app/std.php');


	//echo "userID=".$_GET['userID']."<br>";

    $r = mysql_query("SELECT * FROM ridetransaction WHERE userID=".$_GET['userID']." ORDER BY ID ASC LIMIT 0,20");

    echo "
    {\"ridehistory\":[
    "."<br>";
    while( $row = mysql_fetch_assoc($r) ){
    	 echo "{\"ID\":\"".$row['ID']."\", \"vinID\":\"".$row['vinID']."\", \"pickLat\":\"".$row['pickLat'].
    	 "\", \"pickLong\":\"".$row['pickLong']."\", \"deskLat\":\"".$row['desLat']."\", \"desLong\":\"".$row['desLong'].
    	 "\", \"Status\":\"".$row['Status']."\", \"Date\":\"".$row['Date']."\", \"Time\":\"".$row['Time']."\"}"."<br>";
    }
    echo "]}";



echo mysql_error();


?>