<?
//include('_mysql.php');
include('../../../app/_mysql.php');
include('../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();
	echo $_POST['txtUsername'].$_POST['txtPassword'];
	
	$strSQL = "SELECT * FROM staff WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."' 
	and password = '".mysql_real_escape_string(md5($_POST['txtPassword']))."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);

	if(!$objResult)
	{
			echo "Username and Password Incorrect!<br>";?>
			<script type="text/javascript">
				alert("Username or Password Incorrect");
				location.reload();
			</script><?
			//echo $_POST['txtUsername'].$_POST['txtPassword'];
	}
	else
	{

			$_SESSION["S_username"] = $objResult["username"];
			$_SESSION["S_level"] = $objResult["level"];
			
			if($objResult["level"] >=10)
			{?>
				<script type="text/javascript">
					var f ="";
						f += "&txtUsername=<?=$_POST['txtUsername']?>";
						f += "&txtPassword=<?=$_POST['txtPassword']?>";
					$.ajax({
						type: "POST",
						url: "component/content/subcontent/main.php",
						data: "submit="+f,
						beforeSend : function(){
							$(".Content").html('LOADIND ...');
						},
						success: function(msg){
							$(".Content").hide();
							$(".Content").html(msg);
							$(".Content").fadeIn();
							
						}
					});
				</script>
			<?} /*$(".Content").load("abc.php");*/

			else
			{
			/*
			?>
				<script type="text/javascript">
					var f ="";
						f += "&txtUsername=<?=$_POST['txtUsername']?>";
						f += "&txtPassword=<?=$_POST['txtPassword']?>";
					$.ajax({
						type: "POST",
						url: "component/content/evaluate/evaluatecontent.php",
						data: "submit="+f,
						beforeSend : function(){
							$(".Content").html('กำลังเรียกข้อมูล ...');
						},
						success: function(msg){
							$(".Content").hide();
							$(".Content").html(msg);
							$(".Content").fadeIn();
							
						}
					});
				</script>
			<?
			*/
			}
	}
	mysql_close();
?>




<!-- SCRIPT !!!  -->

	

