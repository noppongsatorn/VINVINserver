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
				<font style="color:red;">NOTIFICATIONS</font>: Complain

				<br>
				<table border="1px"  style="margin-left:22px;">
				<!-- Table Head -->
				  <tr>
				    <td style="text-align: center;">ID</td>
				    <td style="text-align: center;">Date</td>
				    <td style="text-align: center;">Time</td>
				    <td style="text-align: center;">userID</td>
				    <td style="text-align: center;">vinID</td>
				    <td style="text-align: center;">Impolite</td>
				    <td style="text-align: center;">Recklessly</td>
				    <td style="text-align: center;">NoHelmet</td>
				    <td style="text-align: center;">OverCharged</td>
				    <td style="text-align: center;min-width:200px;max-width:500px;">Complain</td>
				    <td style="text-align: center;">...</td>
				  </tr>

				<!-- Table Content -->
				<?

				
				 	$sql_complaint = mysql_query("SELECT * FROM complain WHERE solved!=1");
				 	//$result_complaint = mysql_fetch_assoc($sql_complaint);

				 	while( $result_complaint = mysql_fetch_assoc($sql_complaint)){
						?><tr>
							<td>
								<?echo $result_complaint['ID'];?>
							</td>
							<td>
								<?echo $result_complaint['Date'];?>
							</td>
							<td>
								<?echo $result_complaint['Time'];?>
							</td>
							<td>
								<?echo $result_complaint['userID'];?>
							</td>
							<td>
								<?echo $result_complaint['vinID'];?>
							</td>
							<td <?if($result_complaint['impolite']==1)echo "style=\"background-color: LightCoral ;\"";else echo "style=\"background-color: lightgreen;\"";?>>
								<?echo $result_complaint['impolite'];?>
							</td>
							<td <?if($result_complaint['recklessly']==1)echo "style=\"background-color: LightCoral ;\"";else echo "style=\"background-color: lightgreen;\"";?>>
								<?echo $result_complaint['recklessly'];?>
							</td>
							<td <?if($result_complaint['noHelmet']==1)echo "style=\"background-color: LightCoral ;\"";else echo "style=\"background-color: lightgreen;\"";?>>
								<?echo $result_complaint['noHelmet'];?>
							</td>
							<td <?if($result_complaint['overCharged']==1)echo "style=\"background-color: LightCoral ;\"";else echo "style=\"background-color: lightgreen;\"";?>>
								<?echo $result_complaint['overCharged'];?>
							</td>
							<td>
								<?echo $result_complaint['complaintxt'];?>
							</td>
							<td style="text-align: center;"> 
								<button style="cursor: pointer;" id="<?=$result_complaint['ID']?>">Ignore</button>
								<script type="text/javascript">
									$("#<?=$result_complaint['ID']?>").click(function(){
										//window.location.replace("ignoreComplaint.php?ID="+"<?=$result_complaint['ID']?>");
										var tab = window.open("ignoreComplaint.php?ID="+"<?=$result_complaint['ID']?>", '_blank');
  										tab.close();
  										location.reload(); 
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
