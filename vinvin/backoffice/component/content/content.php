<link rel="StyleSheet" href="../../style/main.css" type="text/css" />
<?
include('../../../app/_mysql.php');
include('../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

CheckUsernamePassword();
?>
<body>
	<!-- Body START -->
	<div class="Body">

		<!-- HEAD -->
		<div class="Head"><?include('head_content.php');?></div>

		<!-- CONTENT -->
		<div class="ContentWithLeftpanel">
			<?include('leftpanel.php');?>
			<div class="Content">


			</div>
		</div>
		<!-- FOOTER -->
		<div class="Footer"><?include('footer_content.php');?></div>

	<!-- Body END -->
	</div>
</body>





<!-- PHP Function -->
<?

/* --- Check Username & Password --- */
 function CheckUsernamePassword() {
	if (isset($_SESSION['username']))
	{
		//echo "Welcome back, SESSION = ".$_SESSION["username"];
	}
	else
	{
		$strSQL = "SELECT * FROM staff WHERE username = '".mysql_real_escape_string($_POST['txtUsername'])."' 
		and password = '".mysql_real_escape_string(md5($_POST['txtPassword']))."'";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);

		if(!$objResult)
		{
				echo "Username and Password Incorrect! or Session timeout<br>";?>
				<script type="text/javascript">
					alert("Username or Password Incorrect (or session timeout)");
					window.location.replace("../../index.php");
					//location.reload();
				</script><?
				//echo $_POST['txtUsername'].$_POST['txtPassword'];
		}
		else
		{
				$_SESSION["username"] = $objResult["username"];
				$_SESSION["level"] = $objResult["level"];
				echo "<br>SESSION set for username = " . $_SESSION["username"] . " LV = ". $_SESSION["level"] . "<br>";
				
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
				<?}
				else
				{}
		}
		mysql_close();
	}
} 
?>

<!-- SCRIPT !!!  -->

<script type="text/javascript">


</script>
