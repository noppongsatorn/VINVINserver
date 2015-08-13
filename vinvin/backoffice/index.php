<?
@header('Content-type: text/html; charset=utf-8');

session_start();
?>

<head>
		<title>VINVIN Back Office</title>
		<link rel="StyleSheet" href="style/main.css" type="text/css" />

		<script src="js/jq/jquery-1.5.1.min.js"></script>
		<link href="js/jq/jquery-ui-1.8.11.cupertino.css" rel="stylesheet" type="text/css"/>
		<script src="js/jq/jquery-ui-1.8.11.cupertino.min.js"></script>
		<script src="js/jq/jquery-dt.js"></script>

</head>
<body>
	<!-- Body START -->
	<div class="Body">

		<!-- HEAD -->
		<div class="Head"><?include('component/head.php');?></div>

		<!-- CONTENT -->
		<div><?include('component/login.php');?></div>

		<!-- FOOTER -->
		<div class="Footer"><?include('component/footer.php');?></div>

	<!-- Body END -->
	</div>
</body>