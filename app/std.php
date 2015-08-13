<?
	@session_start();
	@header('Content-type: text/html; charset=utf-8');
	
	function GetReqStr(){
		$Init = explode("?",$_SERVER['REQUEST_URI']);
		$Req = explode("&",$Init[1]);
		return $Req[0];
	}

	function GetReqStrSlash(){
		$Init = explode("?",$_SERVER['REQUEST_URI']);
		$Req = explode("/",$Init[1]);
		return $Req[0];
	}

	function GetReqStrSlashAfter(){
		$Init = explode("?",$_SERVER['REQUEST_URI']);
		$Req = explode("/",$Init[1]);
		
		if($Req[1]==""){return "";}

		$Remain="";
		for($i=1; $i<count($Req); $i++){ $Remain.= '/'.$Req[$i]; }

		return $Remain;
	}

	function Redir($URI){
		echo '<script language="JavaScript">location.href=\'' .$URI. '\'</script>';
	}

	function P($ID){
		return $_POST[$ID];
	}
	function G($ID){
		return $_GET[$ID];
	}
	function S($ID){
		return $_SESSION[$ID];
	}
	function IssetP($ID){
		if(isset($_POST[$ID])){return true;}
		else{return false;}
	}
	function IssetG($ID){
		if(isset($_GET[$ID])){return true;}
		else{return false;}
	}
	function IssetS($ID){
		if(isset($_SESSION[$ID])){return true;}
		else{return false;}
	}
	function SetS($Var,$Value){
		$_SESSION[$Var] = $Value;
	}

	function SetTimeZone(){
		date_default_timezone_set("Asia/Bangkok");
	}
?>