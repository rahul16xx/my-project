<?php 
session_start();
include "includes/config.php";
include_once("connection/adsmedia.php");
if(isset($_POST['Submit']))
{
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$buser = base64_encode($username);
	
	$login_sql = "select * from login_master where user_name='$username' and login_status='1'";
	$login_rec = mysql_query($login_sql);
	$login_num = mysql_num_rows($login_rec);
	if($login_num > 0)
	{
		$login_res = mysql_fetch_assoc($login_rec);
		if($login_res['password'] == $password)
		{
			
			$_SESSION['full_name'] = $login_res['full_name'];
			$_SESSION['email_id'] = $login_res['email_id'];
			$_SESSION['login_id'] = $login_res['login_id'];
			$_SESSION['menu_right'] = $login_res['menu_right'];
			echo "<script>
				alert('Admin Panel Welcomes You !!')
				location.replace('dashboard.php');
			</script>";
		}else
		{
			echo "<script>
				alert('Sorry ! Given Password Is Wrong')
				location.replace('index.php?U=$buser');
			</script>";
		}
	}else
	{
		echo "<script>
				alert('Sorry ! You Are Not An Authorised User')
				location.replace('index.php');
			</script>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>


<script language="javascript" src="js/all.js"></script>
<link href="style/stylesheet.css" rel="stylesheet" type="text/css">
</head>

<body onload="u_foc('username')">
<table width="98%" align="center"  border="0" cellspacing="0" cellpadding="0" height="438">
      <tr>
        	
        	<td colspan="2" valign="top">
			<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA">
		
			<tr><td align="center" height="475">
			
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<form name="form1" method="post" onSubmit="return chkvalid()">
			  <table width="500"  border="0" cellpadding="0" cellspacing="0" style="border:solid 1px  #FA9000; ">
                <tr>
                  <td class="heading" colspan="2" style="paddin-left:5px;">Authenticate Here </td>
                </tr>
                <tr>
                  <td width="170" align="left" valign="top" style="border-right: solid 1px #FA9000;"><table width="100%"  border="0" bgcolor="#FFFFFF">
                    <tr>
                      <td height="120" align="center"><IMG src="images/Login-logo.gif"  WIDTH=61 HEIGHT=70 ALT=""></td>
                    </tr>
                    <tr>
                      <td height="50" align="center" valign="top" class="samtext2">Welcome To Admin Panel <br>
                        <span class="samtext3"><b>Banking Management System  </b></span> </td>
                    </tr>
                  </table></td>
                  <td bgcolor="#FFFFFF"><table width="100%"  border="0" align="center">
                    <tr>
                      <td colspan="2" align="center">
					  
					</td>
                    </tr>
                    <tr>
                      <td width="45%" align="right" scope="row" class="samtext3"><b>Username :</b></td>
                      <td width="55%"><input type="text" name="username" id="username" ></td>
                    </tr>
                    <tr>
                      <td align="right" scope="row" class="samtext3"><b>Password :</b></td>
                        <td><input type="password" name="password" value=""></td>
                    </tr>
                    <tr >
                      <th scope="row">&nbsp;                        </th>
                      <th align="left" scope="row">
                        <input type="submit" name="Submit" value="Submit"></th>
                    </tr>
                    <tr>
                      <td colspan="2">
					  	
					  </td>
                    </tr>
                  </table></td>
                </tr>
              </table>
			</form>
			
			
			
			</td>
			</tr>
                    <tr>
                      <td height="10"></td>
                    </tr>
              </table></td>
  </tr>
				<tr>
					<td valign="top">
										</td>
					<td valign="top">
									</td>
				</tr>
				
				
</table>
			
			</td></tr>
			</table>		
		</td>
	</tr>
</table>	

</body>
</html>
