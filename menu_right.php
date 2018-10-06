<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");
$user_id = $_GET['U'];
if(isset($_GET['SP']))
{
	$assign_this_menu_sql = "select menu_right from login_master where login_id='$user_id'";
	$assign_this_menu_rec = mysql_query($assign_this_menu_sql);
	$assign_this_menu_res = mysql_fetch_assoc($assign_this_menu_rec);
	$got_this_menu_right = $assign_this_menu_res['menu_right'];
	#echo "PREV : ".$got_this_menu_right."<hr>";
	$make_now_mr = "";
	$pstat = 0;
	$pmenu = parent_menu($_GET['MM']);
	$got_this_menu_right_arr = explode("@@",$got_this_menu_right);
	for($gtmra = 0; $gtmra < count($got_this_menu_right_arr); $gtmra++)
	{
		$this_gtmra = $got_this_menu_right_arr[$gtmra];
		#echo $this_gtmra."<br>";
		list($gtmraM,$gtmraS) = explode("#",$this_gtmra);
		
		if($gtmraM <> $_GET['MM'])
		{
			if($make_now_mr == "")
			{
				$make_now_mr = $this_gtmra;
			}else
			{
				$make_now_mr = $make_now_mr."@@".$this_gtmra;
			}
		}
		if($pmenu > 0)
		{
			if($gtmraM == $pmenu)
			{
				$pstat++;
			}
		}
	}
	#echo "<hr>NOW : ".$make_now_mr;
	if($pstat > 0)
	{
		$got_this_menu_right = $make_now_mr;
	}else
	{
		if($make_now_mr == "")
		{
			$got_this_menu_right = $pmenu."#";
		}else
		{
			$got_this_menu_right = $make_now_mr."@@".$pmenu."#";
		}
	}
	if($_GET['SP'] != "")
	{
		if($got_this_menu_right == "")
		{
			$now_this_menu_right = $_GET['MM']."#".$_GET['SP'];
		}else
		{
			$now_this_menu_right = $got_this_menu_right."@@".$_GET['MM']."#".$_GET['SP'];
		}
	}else
	{
		$now_this_menu_right = $got_this_menu_right;
	}
	$assign_this_menu_update_sql = "update login_master set menu_right='$now_this_menu_right' where login_id='$user_id'";
	##echo $assign_this_menu_update_sql;exit;
	$assign_this_menu_update_rec = mysql_query($assign_this_menu_update_sql);
	echo "<script>
			location.replace('menu_right.php?menu=".$_GET['menu']."&U=".$user_id."');
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
    <td valign="top" bgcolor="#FBFAFA" class="paddingleftpanel"><?php include_once("header_mr.php");?></td>
  </tr>
 <?php
 $x=$_GET['U'];
if(!isset($_GET['menu']))
{
	 $dsh_menu_qr = "select * from menu_master where parent_menu='0' order by menu_id";
}
elseif(isset($_GET['menu']))
{
	 $dsh_menu_qr = "select * from menu_master where parent_menu='$_GET[menu]' order by menu_id";
}
$dsh_menu_rec = mysql_query($dsh_menu_qr);
?>
  
  <tr>
    <td width="88%" align="center" ><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0" class="tabsborder">
  <tr align="center">
    <td valign="top" bgcolor="#FBFAFA" >&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="75%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr align="center">
        <td height="20" colspan="2" class="mostbtext"><?php echo "WELCOME" ." ". usrname($x);?></td>
        </tr>
		<?php 
		if(isset($_GET['U']))
		{
			$mr_sql = "select * from login_master where login_id='$_GET[U]'";
			$mr_rec = mysql_query($mr_sql);
			$mr_res = mysql_fetch_assoc($mr_rec);
			$recent_mr = $mr_res['menu_right']; //////// Existing menu right
			
		?>
      <tr>
        <td height="60" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr class="heading">
            <td width="14%" height="23" align="center" valign="middle">Sl. No. </td>
            <td width="37%" align="left" valign="middle">Menu Name </td>
            <td width="32%" align="left" valign="middle">Options</td>
            <td width="17%" align="center" valign="middle">Assign / Revoke </td>
          </tr>
          <?php
		  $i = 1;
		  if(isset($_GET['M']))
		  {
		  		$sql = "select * from menu_master where parent_menu='$_GET[M]' and menu_status='1' order by menu_name";
		  }else
		  {
		  		$sql = "select * from menu_master where parent_menu=0 and menu_status='1' order by menu_name";
		   }
		  $rec = mysql_query($sql);
		  #echo $sql;
		  while($res = mysql_fetch_assoc($rec))
		  {
		  	#echo "P :".$res['menu_id']."<br>";
			//############################################## For matching existing menu right ##########################################//
				$A = 0;
				$L = 0;
				$E = 0;
				$D = 0;
				$recent_mr_arr = explode("@@",$recent_mr);
				for($rma = 0; $rma < count($recent_mr_arr); $rma++)
				{
					$this_menu_block = $recent_mr_arr[$rma];
					list($tmbM,$tmbS) = explode("#",$this_menu_block);
					if($tmbM == $res['menu_id'])
					{
						$tmbS_arr = explode(":",$tmbS);
						for($tmbSa = 0; $tmbSa < count($tmbS_arr); $tmbSa++)
						{
							$this_tmbS = $tmbS_arr[$tmbSa];
							switch($this_tmbS)
							{
								case 1:
										$A++;
								break;
								case 2:
										$L++;
								break;
								case 3:
										$E++;
								break;
								case 4:
										$D++;
								break;
							}
						}
					}
				}
			
			//#########################################################################################################################//
			$menu_assign_avail = "";
			$this_first_block = "";
			//################################################# For OnClick For Child ##################################################//
				$child = childornot($res['menu_id']);
				if($child > 0)
				{
					$clk = "onclick=sendtomenu('menu_right.php?menu=".$_GET['menu']."&U=".$_GET['U']."&M=".$res['menu_id']."')";
					$css = "mosttext paddL pointer";
					$ttl = "Click Here For Child";
				}else
				{
					$clk = "";
					$css = "mosttext paddL";
					$ttl = "";
				}
			//##########################################################################################################################//
			//################################################# For Checking Assign & Revoke ###########################################//
			
				include "menu_right_detail.php";
				
			
			//##########################################################################################################################//
			if($i%2 == 0)
			{
				echo "<tr bgcolor=#D7D3D9 ".$clk." title='".$ttl."'>";
			}else
			{
				echo "<tr bgcolor=#ECEAED ".$clk." title='".$ttl."'>";
			}
		  ?>
            <td class="<?php echo $css;?>" height="23"><?php echo $i;?></td>
            <td align="left" class="<?php echo $css;?>"><?php echo ucwords($res['menu_name']);?></td>
            <td align="left" class="<?php echo $css;?>">
			<?php
			if($child == 0)
			{
			?>
			<label>Add
                <input name="add<?php echo $res['menu_id'];?>" type="checkbox" id="add<?php echo $res['menu_id'];?>" value="1" <?php if($A > 0){echo "checked";}?> />
            List
                <input name="list<?php echo $res['menu_id'];?>" type="checkbox" id="list<?php echo $res['menu_id'];?>" value="2" <?php if($L > 0){echo "checked";}?> />
Edit
                <input name="edit<?php echo $res['menu_id'];?>" type="checkbox" id="edit<?php echo $res['menu_id'];?>" value="3" <?php if($E > 0){echo "checked";}?> />
Delete
                <input name="delete<?php echo $res['menu_id'];?>" type="checkbox" id="delete<?php echo $res['menu_id'];?>" value="4" <?php if($D > 0){echo "checked";}?> />
</label>
<?php
}else
{
		echo "Child Available";
}
?></td>
            <td align="center" class="<?php echo $css;?>"><?php if($child == 0){echo $set_img;}else{echo "&nbsp;";}?></td>
            </tr>
          <?php
		  	$i++;
		  }
		  ?>
        </table></td>
        </tr>
		<?php
		}elseif(isset($_GET['G']))
		{
		?>
      <tr>
        <td height="60" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr class="heading">
            <td width="10%" height="23" align="center" valign="middle">Sl. No. </td>
            <td width="29%" align="left" valign="middle">Full Name </td>
            <td width="28%" align="left" valign="middle">User Name </td>
            <td width="33%" align="left" valign="middle">Email Address </td>
          </tr>
          <?php
		  $i = 1;
		  
		  $sql = "select * from login_master where group_id='$_GET[G]' order by full_name";
		  $rec = mysql_query($sql);
		  while($res = mysql_fetch_assoc($rec))
		  {
		  	if($i%2 == 0)
			{
				echo "<tr bgcolor=#D7D3D9 onclick=sendtomenu('menu_right.php?menu=".$_GET['menu']."&U=".$res['login_id']."') title='Click Here For Menu List'>";
			}else
			{
				echo "<tr bgcolor=#ECEAED onclick=sendtomenu('menu_right.php?menu=".$_GET['menu']."&U=".$res['login_id']."') title='Click Here For Menu List'>";
			}
		  ?>
            <td class="mosttext paddL pointer" height="23"><?php echo $i;?></td>
            <td align="left" class="mosttext paddL pointer"><?php echo ucwords($res['full_name']);?></td>
            <td align="left" class="mosttext paddL pointer"><?php echo $res['user_name'];?></td>
            <td align="left" class="mosttext paddL pointer"><?php echo $res['email_id'];?></td>
          </tr>
          <?php
		  	$i++;
		  }
		  ?>
        </table></td>
      </tr>
	  <?php
	  }else
	  {
	  ?>
	   <tr>
        <td height="60" colspan="2" align="center" valign="middle"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr class="heading">
            <td width="12%" height="23" align="center" valign="middle">Sl. No. </td>
            <td width="88%" align="left" valign="middle">Group Name </td>
            </tr>
          <?php
		  $i = 1;
		  
		  $sql = "select * from group_master order by group_master_name";
		  $rec = mysql_query($sql);
		  while($res = mysql_fetch_assoc($rec))
		  {
		  	if($i%2 == 0)
			{
				echo "<tr bgcolor=#D7D3D9 onclick=sendtomenu('menu_right.php?menu=".$_GET['menu']."&G=".$res['group_master_id']."') title='Click Here For Menu List'>";
			}else
			{
				echo "<tr bgcolor=#ECEAED onclick=sendtomenu('menu_right.php?menu=".$_GET['menu']."&G=".$res['group_master_id']."') title='Click Here For Menu List'>";
			}
		  ?>
            <td class="mosttext paddL pointer" height="23"><?php echo $i;?></td>
            <td align="left" class="mosttext paddL pointer"><?php echo ucwords($res['group_master_name']);?></td>
            </tr>
          <?php
		  	$i++;
		  }
		  ?>
        </table></td>
      </tr>
	  <?php 
	  }
	  ?>
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
