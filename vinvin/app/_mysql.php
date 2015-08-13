<?
	// Server
	mysql_connect("localhost","nop","NaritaTerminal2") or die("connection error");
	mysql_select_db("nop") or die("db error");

	
	mysql_query( "SET NAMES utf8");
	date_default_timezone_set('Asia/Bangkok');

/*
	// local Macbook XAMPP
	mysql_connect("localhost","root") or die("connection error");
	mysql_select_db("nop") or die("db error");

	
	mysql_query( "SET NAMES utf8");
	date_default_timezone_set('Asia/Bangkok');
*/
?>