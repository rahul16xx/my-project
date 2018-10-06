<?php 
include "includes/config.php";
include_once("connection/adsmedia.php");
?>

<SCRIPT language="JavaScript">
<!--

function startclock()
{
var thetime=new Date();

var nhours=thetime.getHours();
var nmins=thetime.getMinutes();
var nsecn=thetime.getSeconds();
var nday=thetime.getDay();
var nmonth=thetime.getMonth();
var ntoday=thetime.getDate();
var nyear=thetime.getYear();
var AorP=" ";

if (nhours>=12)
    AorP="P.M.";
else
    AorP="A.M.";

if (nhours>=13)
    nhours-=12;

if (nhours==0)
   nhours=12;

if (nsecn<10)
 nsecn="0"+nsecn;

if (nmins<10)
 nmins="0"+nmins;

if (nday==0)
  nday="Sunday";
if (nday==1)
  nday="Monday";
if (nday==2)
  nday="Tuesday";
if (nday==3)
  nday="Wednesday";
if (nday==4)
  nday="Thursday";
if (nday==5)
  nday="Friday";
if (nday==6)
  nday="Saturday";

nmonth+=1;

if (nyear<=99)
  nyear= "19"+nyear;

if ((nyear>99) && (nyear<2000))
 nyear+=1900;

document.clockform.clockspot.value=nhours+": "+nmins+": "+nsecn+" "+AorP+" "+nday+", "+ntoday+"-"+nmonth+"-"+nyear;

setTimeout('startclock()',1000);

} 

//-->
</SCRIPT>
<script language="javascript">
function logout()
{
	var msg = confirm('Are You Really Want To Logout!!');
	if(msg == true)
	{
		location.replace('logout.php');
	}
	
}
</script>
<script language="javascript" src="include/rclick_off.js"></script>

<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="115" align="center" valign="top" background="images/index_04.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="364" align="center" valign="middle"><a href="#"></a><img src="images/Vohra_brothers_vector.jpg" width="420" height="96" /></td>
        <td height="115" align="center" class="mostbtext"><?php echo $_SESSION['full_name'];?></td>
        <td width="388" align="right" valign="top">
		<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" class="padtopright">
			<?php if($_SESSION['login_id'] != ""){?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="23" align="center" valign="middle" background="images/index_07.gif" class="bordertoptable">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    
					<td width="30%" align="center" valign="middle"><a href="profile.php" class="mostlink">My Profile </a></td>
                    <td width="3%" align="center" valign="middle"><img src="images/index_50.gif" width="1" height="21" /></td>
                    <td width="41%" align="center" valign="middle"><a href="change_password.php" class="mostlink">Change Password  </a></td>
					
                    <td width="2%" align="center" valign="middle"><a href="javascript:logout()" class="mostlink"></a><img src="images/index_50.gif" width="1" height="21" /></td>
                    <td width="24%" align="center" valign="middle"><a href="javascript:logout()" class="mostlink">Log Off</a><a href="#" class="mostlink"></a></td>
                  </tr>
                </table>				</td>
              </tr>
              <tr>
                <td height="35" align="right" valign="bottom">&nbsp;</td>
              </tr>
            </table>
			<?php }?>			</td>
          </tr>
          <tr>
            <td height="43" align="right" valign="middle" class="paddate"><form name="clockform">
      <input type="text" name="clockspot" size="43" class="clocktextbox" readonly>
    </form>
	<SCRIPT language="JavaScript">
<!--
startclock();
//-->
</SCRIPT></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="30" align="left" valign="middle">
	
	  
<table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/index_07.gif">
  <tr>
    <td align="left"><table border="0" cellspacing="0" cellpadding="0" align="center">
      <tr height="23">
        <td align="right"  class="link" width="12">&nbsp;</td>
        <td align="right"  class="link" width="56"><a href="dashboard.php" class="mostbtext" title="Home">Home</a></td>
        <td align="right"  class="link" width="18">|</td>
        <?php 
		
		$sel_menu_qr = "select * from menu_master where parent_menu='0' and menu_status='1' ";
		$sel_menu_rec = mysql_query($sel_menu_qr) or die(mysql_error());
		while($sel_menu_res = mysql_fetch_assoc($sel_menu_rec))
		{
			if(in_array($sel_menu_res['menu_id'],$assigned_menu))
			{
		?>
        <td align="center" class="link"><?php if($sel_menu_res['menu_lnk'] == "#"){?><a href="dashboard.php?menu=<?php echo $sel_menu_res['menu_id'];?>" class="mostbtext" title="<?php echo $sel_menu_res['menu_name'];?>"><?php echo $sel_menu_res['menu_name'];?></a><?php }else {?><a href="<?php echo $sel_menu_res['menu_lnk'] ?>?menu=<?php echo $sel_menu_res['menu_id'];?>" class="mostbtext" title="<?php echo $sel_menu_res['menu_name'];?>"><?php echo $sel_menu_res['menu_name'];?></a><?php }?></td>
        <td align="right" class="link" width="16">|</td>
        <?php 
			}
		} 
		 ?>
        
        <td align="right" class="link" width="58" ><a href="#" class="mostbtext" title="Logout" onClick="logout();">Logout</a></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php 
  $head_show = mysql_query("select menu_name from menu_master where menu_id='$_GET[menu]'") or die(mysql_error());
  $head_shop_res = mysql_fetch_assoc($head_show);
   ?>
  <tr>
    <td width="44%" class="heading" align="left">
	<?php 
	if($_GET['menu'])
	{
	
	$nav_qr = mysql_query("select * from menu_master where menu_id='$_GET[menu]'") or die(mysql_error()); 
	$nav_res = mysql_fetch_assoc($nav_qr);
		if($nav_res['parent_menu'] == '0')
		{
			if($nav_res['menu_link']=='#')
			{
				echo  "<a href='dashboard.php?menu=".$nav_res['menu_id']."' class='s_link'>".$nav_res['menu_name']."</a>";
			}else
			{
				echo  "<a href='".$nav_res['menu_lnk']."?menu=".$nav_res['menu_id']."' class='s_link'>".$nav_res['menu_name']."</a>";
			}
		}
		elseif($nav_res['menu_link']=='#')
		{
		$ch_nav_qr = mysql_query("select * from menu_master where menu_id='$nav_res[parent_menu]'") or die(mysql_error());
		$ch_nav_res = mysql_fetch_assoc($ch_nav_qr);
		echo "<a href='dashboard.php?menu=".$ch_nav_res['menu_id']."' class='s_link'>".$ch_nav_res['menu_name']."</a> <img src='images/r_arrowmain.gif'> <a href='".$nav_res['menu_lnk']."?menu=".$nav_res['menu_id']."' class='s_link'>".$nav_res['menu_name']."</a>";
		}
		else
		{
			$fnl_nav_qr = mysql_query("select * from menu_master where menu_id='$nav_res[parent_menu]'") or die(mysql_error());
			$fnl_nav_res = mysql_fetch_assoc($fnl_nav_qr);
			$par_nav_qr = mysql_query("select * from menu_master where menu_id='$fnl_nav_res[parent_menu]'") or die(mysql_error());
			$par_nav_res = mysql_fetch_assoc($par_nav_qr);
			
			echo "<a href='dashboard.php?menu=".$fnl_nav_res['menu_id']."' class='s_link'>".$fnl_nav_res['menu_name']."</a> </a> <img src='images/r_arrowmain.gif'> <a href='".$nav_res['menu_link']."?menu=".$nav_res['menu_id']."' class='s_link'>".$nav_res['menu_name']."</a>";
		}
	}?></td>
    
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td align="left" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
</table>
