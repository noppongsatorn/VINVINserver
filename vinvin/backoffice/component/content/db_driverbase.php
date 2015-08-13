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
				<font style="color:darkblue;">DATABASE</font>: Driverbase

				<br>
				<table border="1px"  style="margin-left:22px;">
				<!-- Table Head -->
				  <tr>
				    <td style="text-align: center;">ID</td>
				    <td style="text-align: center;">Name</td>
				    <td style="text-align: center;">Tel</td>
				    <td style="text-align: center;">Duration of service use</td>
				    <td style="text-align: center;">Total rides</td>
				    <td style="text-align: center;">Total income</td>
				    <td style="text-align: center;">Total commission</td>
				    <td style="text-align: center;">...</td>
				  </tr>

				<!-- Table Content -->
				<?

				
				 	$sql_vin = mysql_query("SELECT * FROM vin WHERE 1");

				 	while( $result_vin = mysql_fetch_assoc($sql_vin)){
						?><tr>
							<td>
								<?echo $result_vin['ID'];?>
							</td>
							<td>
								<?echo $result_vin['Name'];?>
							</td>
							<td>
								<?echo $result_vin['Tel'];?>
							</td>
							<td>
								<?//echo $result_vin['Tel']; //เอา current date - regis date?>
							</td>
							<td>
								<?echo $result_vin['totalRides'];?>
							</td>
							<td>
								<?echo $result_vin['totalIncome'];?>
							</td>
							<td>
								<?echo $result_vin['totalCommission'];?>
							</td>
							<td style="text-align: center;"> 
								<button style="cursor: pointer;" id="<?=$result_vin['ID']?>">View</button>
								<script type="text/javascript">
									$("#<?=$result_vin['ID']?>").click(function(){
										//window.location.replace("ignoreComplaint.php?ID="+"<?=$result_vin['ID']?>");
										var tab = window.open("viewVin.php?ID="+"<?=$result_vin['ID']?>", '_blank');
  										tab.focus();
									});
								</script>
							</td>
						</tr>
					<?
					}
				?>
				</table>




			</div>
		</div>
		<!-- FOOTER -->
		<div style="height:1300px;widht:100%;"></div>
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
