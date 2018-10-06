<?php
session_start();
include "chk_login.php";
include "includes/config.php";
include_once("connection/adsmedia.php");
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
<table width="98%" height="90%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA">
<tr>
    <td valign="top" bgcolor="#FBFAFA" class="paddingleftpanel"><?php include_once("header.php");?></td>
  </tr>
 <?php
if(!isset($_GET['menu']))
{
	 $dsh_menu_qr = "select * from menu_master where parent_menu='0' and menu_status='1' order by menu_id";
}
elseif(isset($_GET['menu']))
{
	 $dsh_menu_qr = "select * from menu_master where parent_menu='$_GET[menu]' and menu_status='1' order by menu_id";
}
//echo $dsh_menu_qr;exit;
$dsh_menu_rec = mysql_query($dsh_menu_qr);
?>
  
  <tr>
    <td width="88%" align="center" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="tabsborder">
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA" >&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr>
        <td height="20" colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <?php 
		$count = 1;
		while($dsh_menu_res = mysql_fetch_assoc($dsh_menu_rec))
		{ //////////////////////////////////////////////////// while 1.0 started
			if(in_array($dsh_menu_res['menu_id'],$assigned_menu))
			{ //////////////////////////////////////////////// if 1.0 started
		?>
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="140" border="0" cellspacing="0" cellpadding="0" onmouseover="this.className='icontdborder2';" onmouseout="this.className='icontdborder';"  class="icontdborder">
          <tr>
            <td align="center" valign="middle" ><table width="161" height="114" border="0" cellpadding="0" cellspacing="0" class="nav_box">
              <tr>
                <td width="161" height="65" align="center" valign="middle"><a href="<?php if($dsh_menu_res['menu_lnk'] == "#"){echo "dashboard.php?menu=".$dsh_menu_res['menu_id'];}else{echo $dsh_menu_res['menu_lnk']."?menu=".$dsh_menu_res['menu_id'];}?>"><?php if($dsh_menu_res['menu_icon']){?><img src="<?php echo "allicons/".$dsh_menu_res['menu_icon'];?>" alt="<?php echo ucwords($dsh_menu_res['menu_name']);?>" width="75" height="48" border="0" /><?php }else{?><img src="allicons/d_master.gif" alt="<?php echo ucwords($dsh_menu_res['menu_name']);?>" width="75" height="48" border="0" /><?php }?></a></td>
                    </tr>
              <tr>
                <td height="40" align="center"><a href="<?php if($dsh_menu_res['menu_lnk'] == "#"){echo "dashboard.php?menu=".$dsh_menu_res['menu_id'];}else{echo $dsh_menu_res['menu_lnk']."?menu=".$dsh_menu_res['menu_id'];}?>" class="mostbtext" title="<?php echo ucwords($dsh_menu_res['menu_name']);?>"><?php echo ucwords($dsh_menu_res['menu_name']);?></a></td>
                    </tr>
              </table></td>
              </tr>
          </table></td>
          <?php
				if($count%3 == 0)
				{
					echo "</tr><tr>
    						<td height=20>&nbsp;</td>
							</tr>
  						  <tr>";
				}
				$count++;
				}////////////////////////////////////////////////////////////////// if 1.0 closed
			}///////////////////////////////////////////////////////////////////// while 1.0 closed
				?>
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
