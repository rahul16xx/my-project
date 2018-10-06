<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include_once("connection/adsmedia.php");
if(isset($_POST['Submit']))
{
	$cpi = $_POST['cpi'];
	$remark = $_POST['remark'];
	$date = $_POST['dvr'];
	$sl = $_POST['sl'];
	
	$sql = "update to_vendor set to_vendor_received_date='$date',to_vendor_remark='$remark',to_vendor_new_slno='$sl' where to_vendor_id='$cpi'";
	#echo $sql;exit;
	$rec = mysql_query($sql);
	
	echo "<script>
				alert('Received Successfully !!')
				window.close();
				window.opener.location.reload();
			</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<link href="style/stylesheet.css" rel="stylesheet" type="text/css">
<link href="style/style.css" rel="stylesheet" type="text/css">
<script language="javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/calendarDateInput.js"></script>
</head>

<body>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="265" align="center"><form id="form1" name="form1" method="post" action="">
      
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td align="right" valign="top" class="mostbtext">Receive Date </td>
		  <td align="center" valign="top" class="mostbtext">:</td>
		  <td align="left" valign="top"><script>DateInput('dvr', true, 'YYYY-MM-DD')</script></td>
		  </tr>
		<tr>
          <td align="right" valign="top" class="mostbtext">New Serial Number (if any) </td>
          <td align="center" valign="top" class="mostbtext">:</td>
          <td align="left" valign="top"><input name="sl" type="text" id="sl" /></td>
        </tr>
          <tr>
            <td width="33%" align="right" valign="top" class="mostbtext">Vendor Remark </td>
            <td width="4%" align="center" valign="top" class="mostbtext">:</td>
            <td width="63%" align="left" valign="top"><textarea name="remark" cols="50" rows="5" id="remark"></textarea></td>
          </tr>
          <tr>
            <td height="37" align="right" valign="top">&nbsp;</td>
            <td align="center" valign="top">&nbsp;</td>
            <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" />
            <input name="cpi" type="hidden" id="cpi" value="<?php echo $_GET['CP'];?>" /></td>
          </tr>
          </table>
    </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
