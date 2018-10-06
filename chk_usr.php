<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");
$R = $_GET['R'];

$sql = "select * from menu_master where menu_name='$R'";
$rec = mysql_query($sql);
$num = mysql_num_rows($rec);
echo $num;
?>
