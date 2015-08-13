<?
include('../../../../app/_mysql.php');
include('../../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

/* --------------- FILTER ----------------- 

	if($_POST['DEPTNOfilterMNG']=="ALL")
		$Filter1=" ";
	else
		$Filter1=" AND DEPTNO='".$_POST['DEPTNOfilterMNG']."'";
 ---------------------------------------- */
?>


<br>
<table width="850" border="1px"  style="margin-left:22px;">
<!-- Table Head -->
  <tr>
    <td width="50" style="text-align: center;">ID</td>
    <td width="250" style="text-align: center;">Name</td>
    <td width="250" style="text-align: center;">Email</td>
    <td width="120" style="text-align: center;">Tel</td>
    <td width="50" style="text-align: center;">Info</td>
  </tr>

<!-- Table Content -->
<?

$count=1;
for($count=1;$count<1000;$count++){
	$r = mysql_query("SELECT * FROM user WHERE ID = ".$count/*.$Filter1*/);
	$d = mysql_fetch_assoc($r);

	if(mysql_num_rows($r)!=0){
		?><tr>
			<td>
				<?echo $d['ID'];?>
			</td>
			<td>
				<?echo $d['Name'];?>
			</td>
			<td>
				<?echo $d['Email'];?>
			</td>
			<td>
				<?echo $d['Tel'];?>
			</td>
			<td style="text-align: center;"> 
	

						<img id="<?=$d['STAFF_CODE']?>" src="img/content/ic_doc.png" width="15" height="15" alt="<?=$d['POSITION']?>">
						<script type="text/javascript">
							/*$(document).ready(function(){
									$("#<?=$d['STAFF_CODE']?>").button();});
							$("#<?=$d['STAFF_CODE']?>").click(function(){
									SendData($(this).attr('id'),$(this).attr('alt'));});

							function SendData(stfcode,position){
									var f ="";
									f += "&txtUsername=<?=$_POST['txtUsername']?>";
									f += "&STAFF_CODE="+stfcode;
									f += "&POSITION="+position;
										$.ajax({
											type: "POST",
											url: "component/content/hr/hrform.php",
											data: "submit="+f,
											beforeSend : function(){
												$(".Content").html('กำลังส่งข้อมูล ...');
											},
											success: function(msg){
												$(".Content").hide();
												$(".Content").html(msg);
												$(".Content").fadeIn();
											}
										});
							}*/
						</script>
			</td>
		</tr>
<?
	}
}

?>
</table>

<!-- SCRIPT !!! -->

<script type="text/javascript">

</script>
