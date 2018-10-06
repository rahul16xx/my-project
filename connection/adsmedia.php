<?php
$hostname_adsmedia = "localhost";
$database_adsmedia = "vohra_brothers";
$username_adsmedia = "root";
$password_adsmedia = "";
$adsmedia = mysql_pconnect($hostname_adsmedia, $username_adsmedia, $password_adsmedia) or trigger_error(mysql_error(),E_USER_ERROR);mysql_select_db($database_adsmedia,$adsmedia);
?> 
