<?php
include "includes/config.php";
include "connection/connection.php";


if(isset($_POST['Submit']))
{
	$funame = $_POST['full_name'];
	if($_POST["email_id"])
	{
		if (filter_var($_POST["email_id"], FILTER_VALIDATE_EMAIL))
		{
			$email=$_POST['email_id'];
		}
		else
		{
			echo "<script>
					alert('Please Enter A Valid Email ID')
					location.replace('contactus.php?')
					</script>";
			return false;
		}
	}	
	$store = $_POST['store_info'];
	mysql_select_db(hall);
	$ssql = "insert into contact_master(full_name,email_id,keep_it) values('$funame','$email','$store')";
	$srec = mysql_query($ssql);

	echo "<script>
			alert('Query Submitted')
			location.replace('contactus.php?')
			</script>";			
}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<script language="javascript" src="js/query.js"></script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #666666">
  <tr>
    <td bgcolor="#000000"><?php include "includes/picture.php";?></td>
  </tr>
  <tr>
    <td bgcolor="#9999FF"><?php include "includes/header.php";?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#99CCFF"><form id="form1" name="form1" method="post" action=""  onsubmit="return query_chk()">
      <table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="41%" height="30" align="right"><strong>Your Name </strong></td>
          <td width="4%" align="center">:</td>
          <td width="55%" align="left"><input name="full_name" type="text" id="full_name" /></td>
        </tr>
        <tr>
          <td height="30" align="right"><strong>Email Address </strong></td>
          <td align="center">:</td>
          <td align="left"><input name="email_id" type="text" id="email_id" /></td>
        </tr>
        <tr>
          <td height="30" align="right" valign="top"><strong>Any Query </strong></td>
          <td align="center" valign="top">:</td>
          <td align="left" valign="top"><textarea name="store_info" cols="50" rows="5" id="store_info"></textarea></td>
        </tr>
        <tr>
          <td height="30" align="right"></td>
          <td align="center"></td>
          <td align="left"><p>
              <input type="submit" name="Submit" value="Submit" />
              <input name="Reset" type="reset" id="Reset" value="Reset" />
          </p></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td bgcolor="#9999FF"><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>
