<?@header('Content-type: text/html; charset=utf-8');?>
<form action="complain_receive_fromuser.php" method="post">
	impolite: <input type="text" name="impolite" value="0"><br>
	recklessly: <input type="text" name="recklessly" value="0"><br>
	No Helmet: <input type="text" name="noHelmet" value="0"><br>
	Over Charged: <input type="text" name="overCharged" value="0"><br>
  	Complain: <input type="text" name="complaintxt" value="มารับช้ามาก"><br>

  	userID: <input type="text" name="userID" value="1"><br>
  	vinID: <input type="text" name="vinID" value="2"><br>

  <input type="submit" value="Submit">
</form>