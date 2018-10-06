<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");
if(isset($_POST['Submit']))
{
		$fname = $_POST['fname'];
		$email = $_POST['email'];
		
		$sql = "update login_master set full_name='$fname',email_id='$email' where login_id='$_SESSION[login_id]'";
		$rec = mysql_query($sql);
		
		$_SESSION['full_name'] = $fname;
		$_SESSION['email_id'] = $email;
		
		echo "<script>
				location.replace('dashboard.php');
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
</head>

<body>
<table width="98%" height="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA">
<tr>
    <td valign="top" bgcolor="#FBFAFA" class="paddingleftpanel"><?php include_once("header.php");?></td>
  </tr>
 
  
  <tr>
    <td width="88%" align="center" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="tabsborder">
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA" >&nbsp;</td>
  </tr>
  
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr>
        <td height="35" colspan="2" align="right" class="note">* Mandatory Feilds </td>
        </tr>
      <tr>
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_nullCO();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="43%" height="25" align="right">Full Name      </td>
              <td width="3%" align="center">:</td>
              <td width="54%" align="left" class="pad_l note">
			   
 <input name="fname" type="text" id="fname" value="<?php echo $_SESSION['full_name'];?>" />
 *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="43%" height="25" align="right">Email Id      </td>
              <td width="3%" align="center">:</td>
              <td align="left" class="pad_l note">
                <input name="email" type="text" id="email" value="<?php echo $_SESSION['email_id'];?>" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
            </tr>
          </table>
                
        </form>        </td>
        </tr>
      <tr>
        <td height="20" colspan="2">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  
  
  
</table>
</body>
</html>
