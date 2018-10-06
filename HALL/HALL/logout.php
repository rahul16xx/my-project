<?php   
session_start(); //to ensure you are using same session
include "includes/config.php";
include "connection/connection.php";

session_destroy(); //destroy the session
	echo"<script>
		alert('Logged Out Successfully!!');
		location.replace('index.php?')
	</script>";
exit();
?>