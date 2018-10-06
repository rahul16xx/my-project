<?php
session_start();
session_destroy();
echo "<script>
				alert('Successfully Logged Out !!')
				location.replace('index.php');
			</script>";
?>
