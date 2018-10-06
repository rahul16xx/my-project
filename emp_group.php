<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include_once("connection/adsmedia.php");
include "includes/functions.php";
######################################## Block of code to insert data ##################################
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO group_master (group_master_name, group_master_status) VALUES (%s, %s)",
                       GetSQLValueString($_POST['group'], "text"),
					   GetSQLValueString($_POST['gr_status'], "int"));

  $Result1 = mysql_query($insertSQL) or die(mysql_error());
	
  $insertGoTo = "emp_group.php?menu=$_POST[menu]&DONE";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
############################################################################################
########################## Block of code to change status ################################## 
if(isset($_GET['S']))
{
	if($_GET['S'] == 0)
	{
		$SS = "Inactive";
	}else
	{
		$SS = "Active";
	}
	$sup_sql = mysql_query("update group_master set group_master_status='$_GET[S]' where group_master_id='$_GET[I]'");
	echo "<script>
				alert('Status Changed To ".$SS." For This Group Successfully !!')
				location.replace('emp_group.php?menu=".$_GET['menu']."');
			</script>";
}
##############################################################################################
########################### Block of code to get data for edit ##############################
if(isset($_GET['E']))
{
	$sup_sql = mysql_query("select * from group_master where group_master_id='$_GET[I]'");
	$sup_res = mysql_fetch_assoc($sup_sql);
}
###############################################################################################
########################### Block of code for Editing Data ####################################
if(isset($_POST['Submit']))
{
	if($_POST['Submit'] == "Edit")
	{
		$esql = mysql_query("update group_master set group_master_name='$_POST[group]',group_master_status='$_POST[gr_status]' where group_master_id='$_POST[Eid]'");
		
		echo "<script>
				alert('Group Edited Successfully')
				location.replace('emp_group.php?menu=".$_POST['menu']."');
			</script>";
	}
}
##############################################################################################
########################### Block of code for deletion #######################################
if(isset($_GET['D']))
{
	$sup_sql = mysql_query("delete from group_master where group_master_id='$_GET[I]'");
	echo "<script>
				alert('Group Deleted Successfully')
				location.replace('emp_group.php?menu=".$_GET['menu']."');
			</script>";
}
##############################################################################################
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
        <td height="35" colspan="2" align="right" class="note" style="padding-right:5px;">* Mandatory Feilds </td>
        </tr>
      <tr>
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_nullTD();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr>
              <td width="48%" height="25" align="right">Group Name    </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="group" type="text" id="group" value="<?php echo $sup_res['group_master_name'];?>" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			
            <tr>
              <td height="25" align="right">Group Status    </td>
              <td align="center">:</td>
              <td align="left"class="pad_l mosttext"><input name="gr_status" type="radio" value="1" <?php if(isset($_GET['E'])){if($sup_res['group_master_status'] == 1){echo "checked='checked'";}}else{?>checked="checked"<?php }?> />
                Active
                  <input name="gr_status" type="radio" value="0" <?php if(isset($_GET['E'])){if($sup_res['group_master_status'] == 0){echo "checked='checked'";}}?>/> 
                  Inactive</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="<?php if(isset($_GET['E'])){echo "Edit";}else{echo "Submit";}?>" /></td>
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
  $query_Recordset1 = "SELECT * FROM group_master";
			
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
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">List of Group </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="7" align="center"> <?php
			
				$explodeme2=$pageclassobject->pageprinting($maxRows_rr);
				$strarray2=explode("#",$explodeme2);	
				$startRow_rr=$strarray2[0];
				$numrow_1=$strarray2[1];
		  ?></td>
            </tr>
          <tr class="heading">
            <td width="6%" height="23" align="center">Sl. No. </td>
            <td width="46%">Group Name </td>
            
            <td width="17%" align="center">Status</td>
            <td width="16%" align="center">Make It </td>
            <td width="15%" align="center">Options</td>
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
            <td valign="top"><?php echo $row_Recordset1['group_master_name'];?></td>
            
            <td align="center" valign="top">
			<?php if($row_Recordset1['group_master_status'] == 1){?>
			<img src="images/green.gif" width="24" height="24" title="Active" />
			<?php }else{?>
			<img src="images/red.gif" width="24" height="24" title="Inactive" />
			<?php }?></td>
            <td align="center" valign="top"><?php if($row_Recordset1['group_master_status'] == 0){?>
              <a href="emp_group.php?menu=<?php echo $_GET['menu'];?>&S=1&I=<?php echo $row_Recordset1['group_master_id'];?>"><img src="images/green.gif" width="24" height="24" border="0" title="Make It Active" /></a>
              <?php }else{?>
              <a href="emp_group.php?menu=<?php echo $_GET['menu'];?>&S=0&I=<?php echo $row_Recordset1['group_master_id'];?>"><img src="images/red.gif" width="24" height="24" border="0" title="Make It Inactive" /></a>
			  <?php }?></td>
            <td align="center" valign="top"><?php if($AE == 1){?><a href="emp_group.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['group_master_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('emp_group.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['group_master_id'];?>&D')"> Delete</a> <?php }?></td>
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
