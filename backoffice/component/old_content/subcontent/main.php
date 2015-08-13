<?
include('../../../../app/_mysql.php');
include('../../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();


//$r = mysql_query("SELECT * FROM eva_personnel WHERE STAFF_CODE = ".$_POST['txtUsername']);
//$d = mysql_fetch_assoc($r);?>
<div class="ContentHead">
	<?
	echo "<div style='float:left; margin-left:22px; margin-top:20px; height:40px; width:450px;'>Welcome to VINVIN back office</div>";
	?>
	<div style='float:right; margin-right:25px; margin-top:20px; height:17px;'>
		<button id="Complain_Page_Button">View Complain</button>
	</div>
	<div style='float:right; margin-right:25px; margin-top:20px; height:17px;'>
		<button id="Add_Vin_Credit_Button">Add Vin Credit</button>
	</div>
	<div style='float:left; margin-left:22px; margin-top:0px; height:40px; width:600px;'>
		<div style='float:left; height:17px; width:17px;'>
			<button id="USER">USER</button>
		</div>&nbsp;
		<div style='float:left; margin-left:35px; height:17px; width:17px;'>
			<button id="VIN">VIN</button>
		</div>&nbsp;
		<div style='float:left; margin-left:30px; height:17px; width:17px;'>
			<button id="STAFF">STAFF</button>
		</div>
	</div>
</div>
<br><br>

<div class="ContentTable">
</div>



<!-- SCRIPT !!! 
		$('#ALL').button();
		$('#SA').button();
		$('#AC').button();
		$('#PC').button();
		$('#DV').button();
		$('#EN').button();
		$('#BS').button();-->

<script type="text/javascript">

$(document).ready(function(){
		Call_table_user();
		$('#Add_Vin_Credit_Button').button();
		$('#Complain_Page_Button').button();
	});


$('#USER').click(function(){
		Call_table_user();
	});

$('#VIN').click(function(){
		Call_table_vin();
	});
$('#STAFF').click(function(){
		Call_table_staff();
	});


$('#Add_Vin_Credit_Button').click(function(){
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
	});

$('#Complain_Page_Button').click(function(){
		Call_table_complain();
	});




function Call_table_user(){
		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
		//f += "&DEPTNOfilterMNG=ALL";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/table_user.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".ContentTable").html('LOADING ...');

				},
				success: function(msg){
					$(".ContentTable").hide();
					$(".ContentTable").html(msg);
					$(".ContentTable").fadeIn();
					
				}
		});
}

function Call_table_vin(){
		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/table_vin.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".ContentTable").html('LOADING ...');

				},
				success: function(msg){
					$(".ContentTable").hide();
					$(".ContentTable").html(msg);
					$(".ContentTable").fadeIn();
					
				}
		});
}

function Call_table_staff(){
		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/table_staff.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".ContentTable").html('LOADING ...');

				},
				success: function(msg){
					$(".ContentTable").hide();
					$(".ContentTable").html(msg);
					$(".ContentTable").fadeIn();
					
				}
		});
}

function Call_table_complain(){
		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
		//f += "&DEPTNOfilterMNG=ALL";
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/complain/table_complain.php",
				data: "submit="+f,

				beforeSend : function(){
					$(".ContentTable").html('LOADING ...');

				},
				success: function(msg){
					$(".ContentTable").hide();
					$(".ContentTable").html(msg);
					$(".ContentTable").fadeIn();
					
				}
		});
}

</script>
