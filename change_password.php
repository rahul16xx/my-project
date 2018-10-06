<?php
session_start();
include "chk_login.php";
include "includes/config.php";
include_once("connection/adsmedia.php");

if(isset($_POST['Submit']))
{
	$old_pass = md5($_POST['old_pass']);
	$new_pass = md5($_POST['new_pass']);
	
	$get_sql = "select * from login_master where login_id='$_SESSION[login_id]'";
	$get_rec = mysql_query($get_sql);
	$get_res = mysql_fetch_assoc($get_rec);
	if($get_res['password'] == $old_pass)
	{
		$ch_sql = "update login_master set password='$new_pass' where login_id='$_SESSION[login_id]'";
		$ch_rec = mysql_query($ch_sql);
		echo "<script>
				alert('Password Changed Successfully !!')
				location.replace('logout.php');
			</script>"; 
	}else
	{
		echo "<script>
				alert('Old Password Is Not Correct !!')
				location.replace('change_password.php?');
			</script>"; 
	}
	
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

<body onload="u_foc('old_pass')">
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
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form id="form1" name="form1" method="post" action="" onsubmit="return chk_nullP();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="48%" height="25" align="right">Old Password </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="old_pass" type="password" id="old_pass" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">New Password   </td>
              <td align="center">:</td>
              <td align="left"class="pad_l note">
                <input name="new_pass" type="password" id="new_pass" onblur="cnt_pchar(this.value,this.id)" />
                *
              (Not Less Than 10 Character)</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">Re-Type New Password  </td>
              <td align="center">:</td>
              <td align="left" class="pad_l note">
                <input name="renew_pass" type="password" id="renew_pass" />
                *
              </td>
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
                </form>
        </td>
          
        </tr>
      <tr>
        <td height="20" colspan="2">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>
</body>
</html>
