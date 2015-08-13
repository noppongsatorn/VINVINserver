<?
include('../../../../../app/_mysql.php');
include('../../../../../app/lib.php');
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
    <td width="100" style="text-align: center;">userID</td>
    <td width="100" style="text-align: center;">vinID</td>
    <td width="50" style="text-align: center;">Star</td>
    <td width="300" style="text-align: center;">Complain</td>
    <td width="30" style="text-align: center;">Date</td>
  </tr>

<!-- Table Content -->
<?

for($count=1;$count<1000;$count++){
	$r = mysql_query("SELECT * FROM complain WHERE ID = ".$count/*.$Filter1*/);
	$d = mysql_fetch_assoc($r);

	if(mysql_num_rows($r)!=0){
		?><tr>
			<td>
				<?echo $d['ID'];?>
			</td>
			<td>
				<?echo $d['userID'];?>
			</td>
			<td>
				<?echo $d['vinID'];?>
			</td>
			<td>
				<?echo $d['star'];?>
			</td>
			<td>
				<?echo $d['complaintxt'];?>
			</td>
			<td>
				<?echo $d['Date']."|".$d['Time'];?>
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
