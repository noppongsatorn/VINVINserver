<?
include('../../../../../app/lib.php');
include('../../../../../app/_mysql.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

	$r = mysql_query("SELECT Credit FROM vin WHERE ID = ".$_POST['vinID']);
	$d = mysql_fetch_assoc($r);

	$total_amount=$_POST['amount']+$d['Credit'];
	$sql = "
		UPDATE vin
		SET Credit='".$total_amount."'
		WHERE ID='".$_POST['vinID']."'";
	mysql_query($sql);
?>

<div class="Row" style="text-align:center;">
	Add credit complete<br>
	<?// Show total amount
		$r = mysql_query("SELECT Credit FROM vin WHERE ID = ".$_POST['vinID']);
		$d = mysql_fetch_assoc($r);
		if($d['Credit']==$total_amount)
			echo "Vin ID: ".$_POST['vinID']." / Total: ".$total_amount." baht<br><br>";
	?>
</div>
<div class="Row" style="text-align:center; margin-left: auto; margin-right: auto;">
	<div class="Button" style="margin-left: auto; margin-right: auto; width:400px;">
		<button id="Add_more_Button" style="text-align:center; float:left;">Add more Credit</button>
		<button id="Home_Button" style="text-align:center; float:left;">Back to Home</button>
	</div>

</div>



<!-- SCRIPT !!!  -->
<script type="text/javascript">

$(document).ready(function(){
		$('#Home_Button').button();
		$('#Add_more_Button').button();

	});
$('#Add_more_Button').click(function(){
		Add_more_credit();
	});
$('#Home_Button').click(function(){
		Back_to_home();
	});

function Add_more_credit(){

		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/AddVinCredit/AddVinCredit.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".Content").html('LOADING ...');
				},
				success: function(msg){
					$(".Content").hide();
					$(".Content").html(msg);
					$(".Content").fadeIn();
				}
			});
}

function Back_to_home(){

		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/main.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".Content").html('LOADING ...');
				},
				success: function(msg){
					$(".Content").hide();
					$(".Content").html(msg);
					$(".Content").fadeIn();
				}
			});
}
</script>