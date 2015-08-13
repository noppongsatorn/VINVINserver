
<?
//include('app/_mysql.php');
@header('Content-type: text/html; charset=utf-8');

@session_start();
	if (isset($_SESSION['username']))
	{
		?>
		<script type="text/javascript">
			window.location.href = "component/content/content.php";

		</script>
		<?
	}
?>

<br><br>
<form  action="component/content/content.php" method="post">
<div class="loginbox">
	Username <input type="text" id="username" name="txtUsername" size="25" style="margin-right:50px;"><br>
	Password <input type="password" id="password" name="txtPassword" size="25" style="margin-right:50px;"><br>
	<div class="Button">
		<button id="Login_Button"  style="width:100px;">Login</button>
	</div>
</div>
</form>


<!-- SCRIPT !!! -->
<script type="text/javascript">

$(document).ready(function(){
		$('#Login_Button').button();

	});

$('#Login_Button').click(function(){
		if($("#username").attr('value') == "" ||
			$("#password").attr('value') == "")
		{
				alert("กรุณากรอกข้อมูลให้ครบ");
		}

		else
		{
			//SendData();
		}

	});
/*
function SendData(){

		var f ="";
		f += "&txtUsername="+$("#username").attr('value');
		f += "&txtPassword="+$("#password").attr('value');

		$("input:text").each( function(){
			f+= '&'+$(this).attr('id')+'='+$(this).attr('value'); 
		});

		
			$.ajax({
			
				type: "POST",
				url: "component/content/content.php",
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
*/
</script>