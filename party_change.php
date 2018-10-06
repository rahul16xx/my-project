<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include_once("connection/adsmedia.php");
if(isset($_POST['Submit']))
{
	$cpi = $_POST['cpi'];
	$pname = $_POST['pname'];
	$pcon = $_POST['pcon'];
	$pemail = $_POST['pemail'];
	
	$sql = "update customer_product set customer_product_party_name='$pname',customer_product_party_contact='$pcon',customer_product_paremail='$pemail' where customer_product_id='$cpi'";
	$rec = mysql_query($sql);
	
	echo "<script>
				alert('Party Detail Changed Successfully !!')
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
                <td height="5" colspan="2" align="left"></td>
              </tr>
              <tr>
			  <td width="39%" height="37" align="right" valign="middle" class="mostbtext">Party Name </td>
              <td width="3%" align="center" valign="middle" class="mostbtext">:</td>
                <td width="58%" height="25" colspan="2" align="left" valign="middle"><input name="pname" type="text" id="pname" value="<?php echo $_GET['PN'];?>" /></td>
              </tr>
              <tr>
                <td height="37" align="right" valign="middle" class="mostbtext">Party Contact </td>
                <td align="center" valign="middle" class="mostbtext">:</td>
                <td align="left" valign="middle"><input name="pcon" type="text" id="pcon" value="<?php echo $_GET['PC'];?>" /></td>
              </tr>
              <tr>
                <td height="37" align="right" valign="middle" class="mostbtext">Party Email </td>
                <td align="center" valign="middle" class="mostbtext">:</td>
                <td align="left" valign="middle"><input name="pemail" type="text" id="pemail" value="<?php echo $_GET['PE'];?>"/></td>
              </tr>
          <tr>
          <td height="37" align="right" valign="top">&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td align="left" valign="middle"><input type="submit" name="Submit" value="Submit" />
            <input name="cpi" type="hidden" id="cpi" value="<?php echo $_GET['CR'];?>" /></td>
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
