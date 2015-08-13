<?
// เหลือ เช็คว่า เบอร์ที่สมัครมาแล้ว สมัครซ้ำใหม่ จะทำไง
include('../app/_mysql.php');
include('../app/std.php');

  $sql_user = mysql_query("SELECT * FROM user WHERE PID='".$_POST['PID']."'");
  $result_user = mysql_fetch_assoc($sql_user);


  // Check OTP & Update Status='Registered'
  	if($result_user['OTP']==$_POST['OTP'])
  	{
	    echo "
	    {\"login succeed\":[
	    "."<br>";
	    	 echo "{\"ID\":\"".$result_user['ID']."\"}"."<br>";
	    echo "]}";

	    $sql = "
		    UPDATE user
		    SET Status='Registered'
		    WHERE ID='".$result_user['ID']."'
		    ";
		mysql_query($sql);
	}
	else
	{
	    echo "
	    {\"login fail\":[
	    "."<br>";
	    	 echo "{\"ID\":\"".$result_user['ID']."\"}"."<br>";
	    echo "]}";
	}


echo mysql_error();

?>