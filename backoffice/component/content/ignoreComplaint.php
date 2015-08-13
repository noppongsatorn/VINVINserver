<link rel="StyleSheet" href="../../style/main.css" type="text/css" />
<?
include('../../../app/_mysql.php');
include('../../../app/lib.php');
@header('Content-type: text/html; charset=utf-8');
@session_start();

    $sql = "
    UPDATE complain
    SET solved='1'
    WHERE ID='".$_GET['ID']."'
    ";

    mysql_query($sql);
    echo mysql_error();
?>
