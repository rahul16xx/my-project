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
$add = $_POST['add']."<br>".$_POST['city']."<br>".$_POST['state'];
  $insertSQL = sprintf("INSERT INTO vendor_master (vendor_name,vendor_add,vendor_email,vendor_contact,vendor_status) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ven_name'], "text"),
					   GetSQLValueString($add, "text"),
					   GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($_POST['phone'], "text"),
					   GetSQLValueString($_POST['vstatus'], "int"));

  $Result1 = mysql_query($insertSQL) or die(mysql_error());
	echo "<script>
			alert('Vendor Added Successfully');
		</script>";
  $insertGoTo = "vendor_details.php?menu=$_POST[menu]&DONE";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
############################################################################################
########################## Block to get zone name #########################################
$query_Recordset2 = "SELECT zone_master_id, zone_master_name FROM zone_master ORDER BY zone_master_name ASC";
$Recordset2 = mysql_query($query_Recordset2) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
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
	#echo "update login_master set login_status='$_GET[S]' where group_master_id='$_GET[I]'";exit;
	$sup_sql = mysql_query("update vendor_master set vendor_status='$_GET[S]' where vendor_id='$_GET[I]'");
	
	echo "<script>
				alert('Status Changed To ".$SS." For This Vendor Successfully !!')
				location.replace('vendor_details.php?menu=".$_GET['menu']."');
			</script>";
}
##############################################################################################
########################### Block of code to get data for edit ##############################
if(isset($_GET['E']))
{
	$sup_sql = mysql_query("select * from vendor_master where vendor_id='$_GET[I]'");
	$sup_res = mysql_fetch_assoc($sup_sql);
	list($a,$c,$s) = explode("<br>",$sup_res['vendor_add']);
}
###############################################################################################
########################### Block of code for Editing Data ####################################
if(isset($_POST['Submit']))
{
	if($_POST['Submit'] == "Edit")
	{
		$add = $_POST['add']."<br>".$_POST['city']."<br>".$_POST['state'];
		$esql = mysql_query("update vendor_master set vendor_name='$_POST[ven_name]',vendor_add='$add',vendor_email='$_POST[email]',vendor_contact='$_POST[phone]',vendor_status='$_POST[vstatus]' where vendor_id='$_POST[Eid]'");
		
		echo "<script>
				alert('Vendor Edited Successfully')
				location.replace('vendor_details.php?menu=".$_POST['menu']."');
			</script>";
	}
}
##############################################################################################
########################### Block of code for deletion #######################################
if(isset($_GET['D']))
{
	$sup_sql = mysql_query("delete from vendor_master where vendor_id='$_GET[I]'");
	echo "<script>
				alert('Vendor Deleted Successfully')
				location.replace('vendor_details.php?menu=".$_GET['menu']."');
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
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
			 <tr>
              <td width="48%" height="25" align="right">Vendor Name    </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="ven_name" type="text" id="ven_name" value="<?php echo $sup_res['vendor_name'];?>" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="48%" height="25" align="right">Vendor Address </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="add" type="text" id="add" value="<?php echo $a;?>" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			
			 <tr>
              <td width="48%" height="25" align="right">City</td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note"><input name="city" type="text" id="city" value="<?php echo $c;?>" />
              *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="48%" height="25" align="right">State</td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note"><select name="state" id="state">
  <option value="0">... Zone ...</option>
  <?php
do {  
?>
  <option value="<?php echo $row_Recordset2['zone_master_name']?>" <?php if($s == $row_Recordset2['zone_master_name']){echo "selected";}?>><?php echo $row_Recordset2['zone_master_name']?></option>
  <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
  $rows = mysql_num_rows($Recordset2);
  if($rows > 0) {
      mysql_data_seek($Recordset2, 0);
	  $row_Recordset2 = mysql_fetch_assoc($Recordset2);
  }
?>
</select>    
              </td>
            </tr>
			<tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			
			 <tr>
              <td width="48%" height="25" align="right">Phone Number  </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="phone" type="text" id="phone" value="<?php echo $sup_res['vendor_contact'];?>" onKeyPress="{if((event.keyCode&lt;41)){event.returnValue=false;}}" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			
			 <tr>
              <td width="48%" height="25" align="right">Email Address </td>
              <td width="4%" align="center">:</td>
              <td width="48%" align="left" class="pad_l note">
                <input name="email" type="text" id="email" value="<?php echo $sup_res['vendor_email'];?>" onKeyPress="{if((event.keyCode&lt;41)){event.returnValue=false;}}" />
                *</td>
            </tr>
            <tr>
              <td colspan="3" align="right" height="10"></td>
            </tr>
			
            <tr>
              <td height="25" align="right">Vendor Status    </td>
              <td align="center">:</td>
              <td align="left"class="pad_l mosttext"><input name="vstatus" type="radio" value="1" <?php if(isset($_GET['E'])){if($sup_res['vendor_status'] == 1){echo "checked='checked'";}}else{?>checked="checked"<?php }?> />
                Active
                  <input name="vstatus" type="radio" value="0" <?php if(isset($_GET['E'])){if($sup_res['vendor_status'] == 0){echo "checked='checked'";}}?>/> 
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
  $query_Recordset1 = "SELECT * FROM vendor_master order by vendor_name asc";
			
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">List of Vendor </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center"> <?php
			
				$explodeme2=$pageclassobject->pageprinting($maxRows_rr);
				$strarray2=explode("#",$explodeme2);	
				$startRow_rr=$strarray2[0];
				$numrow_1=$strarray2[1];
		  ?></td>
            </tr>
          <tr class="heading">
            <td width="6%" height="23" align="center">Sl. No. </td>
            <td width="23%" align="left">Vendor Name </td>
            <td width="25%" align="left">Address </td>
            <td width="9%" align="center">Status</td>
            <td width="7%" align="center">Make It </td>
            <td width="7%" align="center">Options</td>
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
            <td align="left" valign="top"><?php echo $row_Recordset1['vendor_name'];?></td>
            <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td height="20" class="mosttext"><b>Address : </b><?php echo $row_Recordset1['vendor_add'];?></td>
  </tr>
  <tr>
    <td height="20" class="mosttext"><b>Contact No. : </b><?php echo $row_Recordset1['vendor_contact'];?></td>
  </tr>
  <tr>
    <td height="20" class="mosttext"><b>Email : </b><?php echo $row_Recordset1['vendor_email'];?></td>
  </tr>
</table>
</td>
            <td align="center" valign="top">
			<?php if($row_Recordset1['vendor_status'] == 1){?>
			<img src="images/green.gif" width="24" height="24" title="Active" />
			<?php }else{?>
			<img src="images/red.gif" width="24" height="24" title="Inactive" />
			<?php }?></td>
            <td align="center" valign="top"><?php if($row_Recordset1['vendor_status'] == 0){?>
              <a href="vendor_details.php?menu=<?php echo $_GET['menu'];?>&S=1&I=<?php echo $row_Recordset1['vendor_id'];?>"><img src="images/green.gif" width="24" height="24" border="0" title="Make It Active" /></a>
              <?php }else{?>
              <a href="vendor_details.php?menu=<?php echo $_GET['menu'];?>&S=0&I=<?php echo $row_Recordset1['vendor_id'];?>"><img src="images/red.gif" width="24" height="24" border="0" title="Make It Inactive" /></a>
			  <?php }?></td>
            <td align="center" valign="top"><?php if($AE == 1){?><a href="vendor_details.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['vendor_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('vendor_details.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['vendor_id'];?>&D')"> Delete</a><?php }?> </td>
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
