<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");
if(isset($_POST['Submit']))
{
		$parent = $_POST['parent'];
		$menu_name = $_POST['menu_name'];
		$menu_link = $_POST['menu_link'];
		$menu_icon = $_FILES['menu_icon']['name'];
		$menu_status = $_POST['menu_status'];
	if($_POST['Submit'] == "Submit")
	{
		
		
		$addmenu_sql = "insert into menu_master(menu_name,menu_lnk,parent_menu,menu_status) values('$menu_name','$menu_link','$parent','$menu_status')";
		#echo $addmenu_sql;exit;
		$addmenu_rec = mysql_query($addmenu_sql);
		
		$pk = mysql_insert_id();
		list($n,$e) = explode(".",$menu_icon);
		$new_icon = $pk.".".$e;
		if(move_uploaded_file($_FILES['menu_icon']['tmp_name'],"allicons/".$new_icon))
		{
			$upmenu = "update menu_master set menu_icon='$new_icon' where menu_id='$pk'";
			$upmenu_rec = mysql_query($upmenu);
		}
			echo "<script>
				alert('Menu Added Successfully')
				location.replace('add_menu.php?menu=".$_POST['menu']."');
			</script>";
	}elseif($_POST['Submit'] == "Edit")
	{		
			$parent = $_POST['parent'];
			$menu_name = $_POST['menu_name'];
			$menu_link = $_POST['menu_link'];
			$menu_icon = $_FILES['menu_icon']['name'];
			$menu_status = $_POST['menu_status'];
			$sup_sql = mysql_query("select * from menu_master where menu_id='$_GET[I]'");
			$sup_res = mysql_fetch_assoc($sup_sql);
			list($n1,$e1) = explode(".",$menu_icon);
			$new_icon = $_GET['I'].".".$e1;
			#echo $new_icon;exit;
			$pk1 = $_GET['I'];
			if($menu_icon)
			{
				unlink("allicons/".$new_icon);
			if(move_uploaded_file($_FILES['menu_icon']['tmp_name'],"allicons/".$new_icon))
			{
			#echo joydeep;exit;
			
			
			
				$esql = "update menu_master set         					  
				menu_name='$_POST[menu_name]',menu_lnk='$_POST[menu_link]',parent_menu='$_POST[parent]',menu_icon='$new_icon'
			,menu_status='$_POST[menu_status]' where menu_id='$pk1'";
				
			}
			}
			else
			{
			$esql = "update menu_master set menu_name='$_POST[menu_name]',menu_lnk='$_POST[menu_link]',parent_menu='$_POST[parent]',menu_icon='$sup_res[menu_icon]'
			,menu_status='$_POST[menu_status]'where menu_id='$_GET[I]'";
			
			
			}
			#echo $esql;exit;
			$esql_rec = mysql_query($esql);
			echo "<script>
					alert('Menu Edited Successfully')
					location.replace('add_menu.php?menu=".$_POST['menu']."');
				</script>";
				
	}
}
if(isset($_GET['S']))
{
	if($_GET['S'] == 0)
	{
		$SS = "Inactive";
	}else
	{
		$SS = "Active";
	}
	$sup_sql = mysql_query("update menu_master set menu_status='$_GET[S]' where menu_id='$_GET[I]'");
	echo "<script>
				alert('Status Changed To ".$SS." For This Menu Successfully !!')
				location.replace('add_menu.php?menu=".$_GET['menu']."');
			</script>";
}
if(isset($_GET['E']))
{
	$sup_sql = mysql_query("select * from menu_master where menu_id='$_GET[I]'");
	$sup_res = mysql_fetch_assoc($sup_sql);
}

if(isset($_GET['D']))
{
	$sup_sql = mysql_query("delete from menu_master where menu_id='$_GET[I]'");
	echo "<script>
				alert('Menu Deleted Successfully')
				location.replace('add_menu.php?menu=".$_GET['menu']."');
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
  <?php
  if($AA == 1 || isset($_GET['E']))
  {
  ?>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr>
        <td height="35" colspan="2" align="right" class="note">* Mandatory Feilds </td>
        </tr>
      <tr>
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_nullCO();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="43%" height="25" align="right">Menu Parent     </td>
              <td width="3%" align="center">:</td>
              <td colspan="2" align="left" class="pad_l note">
			  
<select name="parent" id="parent">
<option value="0">Parent</option>
<?php
$menu_sql = "select * from menu_master where menu_status=1 order by menu_name";
$menu_rec = mysql_query($menu_sql);
while($menu_res = mysql_fetch_assoc($menu_rec))
{
?>
  <option value="<?php echo $menu_res['menu_id'];?>" <?php if($sup_res['parent_menu'] == $menu_res['menu_id']){echo "selected";}?>><?php echo $menu_res['menu_name'];?></option>
 <?php
 }
 ?>
</select>                
*</td>
            </tr>
            <tr>
              <td colspan="4" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="43%" height="25" align="right">Menu Name     </td>
              <td width="3%" align="center">:</td>
              <td colspan="2" align="left" class="pad_l note">
                <input name="menu_name" type="text" id="menu_name" value="<?php echo $sup_res['menu_name'];?>" onblur="get_chk_usr(this.value)" />
                *</td>
            </tr>
            <tr>
              <td colspan="4" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="43%" height="25" align="right">Menu Link </td>
              <td width="3%" align="center">:</td>
              <td colspan="2" align="left" class="pad_l note">
                <input name="menu_link" type="text" id="menu_link" value="<?php echo $sup_res['menu_lnk'];?>" /></td>
            </tr>
            <tr>
              <td colspan="4" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="43%" height="25" align="right">Menu Icon</td>
              <td width="3%" align="center">:</td>
              <td width="32%" align="left" class="pad_l note">
<input name="menu_icon" type="file" id="menu_icon" />                
*</td>
              <td width="22%" align="left" class="pad_l note"><?php if(isset($_GET['E'])){?><img src="allicons/<?php echo $sup_res['menu_icon']?>" /><?php }else{?>&nbsp;<?php }?></td>
			</tr>
            <tr>
              <td colspan="4" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">Menu Status    </td>
              <td align="center">:</td>
              <td colspan="2" align="left"class="pad_l mosttext"><input name="menu_status" type="radio" value="1" <?php if(isset($_GET['E'])){if($sup_res['menu_status'] == 1){echo "checked='checked'";}}else{?>checked="checked"<?php }?> />
                Active
                  <input name="menu_status" type="radio" value="0" <?php if(isset($_GET['E'])){if($sup_res['menu_status'] == 0){echo "checked='checked'";}}?>/> 
                  Inactive</td>
            </tr>
            <tr>
              <td colspan="4" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td colspan="2" align="left"><input type="submit" name="Submit" value="<?php if(isset($_GET['E'])){echo "Edit";}else{echo "Submit";}?>" /></td>
            </tr>
          </table>
                <input name="menu" type="hidden" id="menu" value="<?php echo $_GET['menu'];?>" />
				<?php
				if(isset($_GET['E']))
				{
				?>
				<input type="hidden" name="Eid" value="<?php echo $_GET['I'];?>">
				<?php
				}else
				{
				?>
                <input type="hidden" name="MM_insert" value="form1">
				<?php
				}
				?>
        </form>        </td>
        </tr>
      <tr>
        <td height="20" colspan="2">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" valign="top" bgcolor="#FBFAFA">
	<?php
  
  
			$query_Recordset1 = "select * from menu_master order by menu_name";
			$pageclassobject = new pageclass;
			$query_limit_sql = $query_Recordset1;
			// using function paging($sql_1) of class pageclass to get limit of max rows on one page
			$query_limit_rr=$pageclassobject->paging($query_limit_sql,$maxRows_rr);
			///echo $query_limit_rr;
			$Records1 = mysql_query($query_limit_rr);
			$totalRows_Recordset1 = mysql_num_rows($Records1);
			if($totalRows_Recordset1 > 0)
			{
			
  ?>
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="left" class="pad_l mostbbtext">List of Menu </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
      <tr>
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><table width="100%" border="0" cellspacing="1" cellpadding="1">
		<tr>
            <td height="23" colspan="8" align="center"> <?php
			
				$explodeme2=$pageclassobject->pageprinting($maxRows_rr);
				$strarray2=explode("#",$explodeme2);	
				$startRow_rr=$strarray2[0];
				$numrow_1=$strarray2[1];
		  ?></td>
            </tr>
          <tr class="heading">
            <td width="7%" height="23" align="center">Sl. No. </td>
            <td width="22%">Menu  </td>
            <td width="34%">Menu Parent &amp; Icon </td>
            <td width="13%" align="center">Status</td>
            <td width="12%" align="center">Make It </td>
            <td width="12%" align="center">Options</td>
          </tr>
		  <?php
		  $i=1;
		  while($row_Recordset1 = mysql_fetch_assoc($Records1))
		  {
		  	if($i%2 == 0)
			{
				echo "<tr bgcolor=#D7D3D9>";
			}else
			{
				echo "<tr bgcolor=#ECEAED>";
			}
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td valign="top"><p><?php echo $row_Recordset1['menu_name'];?></p>
              <p>Link : <?php echo $row_Recordset1['menu_lnk'];?></p></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="38%" height="104"><?php echo parent_name($row_Recordset1['parent_menu']);?></td>
                <td width="62%" align="center"><img src="allicons/<?php echo $row_Recordset1['menu_icon'];?>" /></td>
              </tr>
            </table></td>
            <td align="center" valign="top"><?php if($row_Recordset1['menu_status'] == 1){?><img src="images/green.gif" width="24" height="24" title="Active" /><?php }else{?><img src="images/red.gif" width="24" height="24" title="Inactive" /><?php }?></td>
            <td align="center" valign="top"><?php if($row_Recordset1['menu_status'] == 0){?>
              <a href="add_menu.php?menu=<?php echo $_GET['menu'];?>&S=1&I=<?php echo $row_Recordset1['menu_id'];?>"><img src="images/green.gif" width="24" height="24" border="0" title="Make It Active" /></a>
              <?php }else{?>
              <a href="add_menu.php?menu=<?php echo $_GET['menu'];?>&S=0&I=<?php echo $row_Recordset1['menu_id'];?>"><img src="images/red.gif" width="24" height="24" border="0" title="Make It Inactive" /></a>
			  <?php }?></td>
            <td align="center" valign="top"><?php if($AE == 1){?><a href="add_menu.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['menu_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('add_menu.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['menu_id'];?>&D')"> Delete</a><?php }?></td>
            </tr>
		  <?php
		  	$i++;
		  }
		  ?>
        </table></td>
      </tr>
      <tr>
        <td height="20" colspan="2">&nbsp;</td>
      </tr>
	  
    </table>
	<?php
	  }
	  ?>
	</td>
  </tr>
  
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  
</table></td>
  </tr>
  
</table>
</body>
</html>
