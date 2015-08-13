<?
include('../../../../../app/lib.php');
include('../../../../../app/_mysql.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

?>

<div class="Row3" style="text-align:center; line-height:20px; padding-top:10px;">
	Add Vin credit<br><br>
	<div style="text-align:center; width:350px; margin-left: auto; margin-right: auto;">
		<table border="0px"  style="text-align:left;">
		 	<tr>
				<td width="110">Vin ID</td>
				<td width="150"><input type="text" id="vinID" size="25" style="margin-right:50px;">
			</tr>
			<tr>
				<td>Add amount</td>
				<td><input type="text" id="amount" size="25" style="margin-right:50px;">
			</tr>
			<tr>
				<td>Operate by</td>
				<td><input type="text" id="staffID" size="25" style="margin-right:50px;" value=<?echo "'".$_POST['txtUsername']."'"?> disabled>
			</tr>
		</table>
	</div>
</div>

<div class="Row" style="text-align:center;">
<div class="Button">
	<button id="Submit_Button" style="text-align:center;">Submit</button>
</div>
</div>


<!-- SCRIPT !!!  -->
<script type="text/javascript">

$(document).ready(function(){
		$('#Submit_Button').button();

	});

$('#Submit_Button').click(function(){
		if($("#amount").attr('value')<0)
			alert("Please input valid amount");

		else
			var txt;
			var r = confirm("Add "+$("#amount").attr('value')+" baht to Vin: "+$("#vinID").attr('value'));
			if (r == true) {
			    SendData();
			} else {
			}

			
	});

function SendData(){

		var f ="";
		f += "&txtUsername=<?=$_POST['txtUsername']?>";
		f += "&vinID="+$("#vinID").attr('value');
		f += "&amount="+$("#amount").attr('value');
		f += "&staffID="+$("#staffID").attr('value');
			$.ajax({
			
				type: "POST",
				url: "component/content/subcontent/AddVinCredit/AddVinCredit_senddata.php",
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