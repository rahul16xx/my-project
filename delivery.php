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
	$date = date('Y-m-d');
	
	$sql = "update product_trans set customer_product_delivery_date='$date',remark='$remark' where product_trans_id='$cpi'";
	$rec = mysql_query($sql);
	
	echo "<script>
				alert('Delivered Successfully !!')
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
          <td width="33%" align="right" valign="top" class="mostbtext">Delivery Remark </td>
          <td width="4%" align="center" valign="top" class="mostbtext">:</td>
          <td width="63%" align="left" valign="top"><textarea name="remark" cols="50" rows="5" id="remark"></textarea></td>
        </tr>
        <tr>
          <td height="37" align="right" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" />
            <input name="cpi" type="hidden" id="cpi" value="<?php echo $_GET['CP'];?>" />
            <input name="Submit" type="submit" id="Submit" value="Proceed" /></td>
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
