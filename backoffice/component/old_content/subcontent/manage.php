<?
include('../../../app/_mysql.php');
include('../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();
	$strSQL = "SELECT * FROM eva_user WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."' 
	and password = '".mysql_real_escape_string(md5($_POST['txtPassword']))."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

echo "hr/manage.php<br>";
echo "username: ".$_POST['txtUsername']." password:".$_POST['txtPassword']."<br>";
echo "md5 password = ".md5($_POST['txtPassword'])."<br>";
echo "Welcome, ".$objResult['name']." ".$objResult['lastname'];
?>


<script type="text/javascript">

</script>