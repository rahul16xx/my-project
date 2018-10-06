<?php
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$uname = $_POST['uname'];
	$pass = md5($_POST['pass']);
	
	$sql = "select * from login_master where username='$uname'";
	$rec = mysql_query($sql);
	$num = mysql_num_rows($rec);
	if($num > 0)
	{
		$res = mysql_fetch_assoc($rec);
		if($pass == $res['password'])
		{
			session_start();
			
			$_SESSION['lid'] = $res['login_id'];
			$_SESSION['fname'] = $res['full_name'];
			$_SESSION['utype'] = $res['user_type'];
			
			echo "<script>
					alert('Successfully Logged In!!!');
					location.replace('booking.php?')
				</script>";
		}else
		{
			echo "<script>
					alert('Wrong Password');
					location.replace('login.php?')
				</script>";
		}
	}else
	{
		echo "<script>
					alert('Wrong User Name');
					location.replace('login.php?')
				</script>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<style>
.box{
border-radius:10px;
background-color:#333333;
color:#FFFFFF;
overflow:hidden;
font-variant:small-caps;
}
.btn{
border-radius:10px;
font-family:Cursive;
font-variant:small-caps;
}
.btn1 {border-radius:10px;
font-family:Cursive;
font-variant:small-caps;
}
</style>
</head>

<body background="images/background.jpg">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="270" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><form id="form1" name="form1" method="post" action="">
      <table width="50%" border="0" cellspacing="0" cellpadding="0" style="border:1px dashed #333333;">
        <tr>
          <td height="25" colspan="2" bgcolor="#182828"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#182828">
            <tr>
              <td width="90%" style="color:#00CC00; font-weight:bold;">
                <marquee behavior="scroll" direction="left" scrollamount="3">
                WELCOME TO MULTIPLEX PORTAL
                </marquee>
                </td>
              <td width="10%" style="color:#999999; font-weight:bold;">V 1.0</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td width="25%" bgcolor="#2C3936"><img src="images/logo.gif" width="150" height="100" /></td>
          <td width="75%" align="center" bgcolor="#2C3936"><table width="97%" border="0" cellspacing="0" cellpadding="0" style="opacity:0.7;">
            <tr>
              <td width="33%" height="30" align="right" bgcolor="#2C3936" style="color:#CCCCCC; font-family:Cursive;"><strong>USERNAME</strong></td>
              <td width="7%" align="center" bgcolor="#2C3936" style="color:#CCCCCC">:</td>
              <td width="60%" colspan="2" align="left" bgcolor="#2C3936"><input name="uname" type="text" id="uname" class="box"/></td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#2C3936">&nbsp;</td>
              </tr>
            <tr>
              <td height="30" align="right" bgcolor="#2C3936" style="color:#CCCCCC; font-family:Cursive;"><strong>PASSWORD</strong></td>
              <td align="center" bgcolor="#2C3936" style="color:#CCCCCC">:</td>
              <td colspan="2" align="left" bgcolor="#2C3936"><input name="pass" type="password" id="pass" class="box"/></td>
            </tr>
            <tr>
              <td colspan="4" bgcolor="#2C3936">&nbsp;</td>
              </tr>
            <tr>
              <td height="30" align="right" bgcolor="#2C3936">&nbsp;</td>
              <td align="center" bgcolor="#2C3936">&nbsp;</td>
              <td align="left" bgcolor="#2C3936"><input type="submit" name="Submit" value="Submit" class="btn"/>
                <input name="Reset" type="reset" class="btn" id="Reset" value="Reset"/></td>
              <td width="5%" align="left" bgcolor="#2C3936"><input name="back" type="button" class="btn1" id="back" value="Go Back" onclick="location.href='index.php';"/></td>
            </tr>
          </table></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td height="665">&nbsp;</td>
  </tr>
</table>
</body>
</html>
