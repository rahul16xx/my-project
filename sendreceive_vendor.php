<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");

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

$tod = $_POST['spb'];
  $sql = "select * from to_vendor where to_vendor_send_date='$tod'";
$rec = mysql_query($sql);
$num = mysql_num_rows($rec);
$num = $num+1;

$rece = "V".date('y').date('m').date('d').$num;
$color= $_POST['prod'];
$CC = 0;
if( is_array($color))
{
	while (list ($key, $val) = each ($color))
	{
		//echo $val."<br>";
		list($ch,$ptid) = explode("%%",$val);
		$pid = challan_to_id($ch);
		$insertSQL = sprintf("INSERT INTO to_vendor (customer_product_id,product_trans_id,vendor_id,to_vendor_challantovendor,remark_to_vendor,purchase_bill_no,purchase_bill_date,to_vendor_send_date) VALUES (%s, %s, %s, %s, %s,%s, %s, %s)",
					   GetSQLValueString($pid, "int"),
					   GetSQLValueString($ptid, "int"),
					   GetSQLValueString($_POST['vendor'], "int"),
					   GetSQLValueString($rece, "text"),
					   GetSQLValueString($_POST['remark'], "text"),
					   GetSQLValueString($_POST['pbill'], "text"),
					   GetSQLValueString($_POST['dpb'], "date"),
					   GetSQLValueString($_POST['spb'], "date"));
					   
	#echo $insertSQL."<hr>";exit;
  $Result1 = mysql_query($insertSQL) or die(mysql_error());
	$CC++;	
	}
}
	if(count($color) == $CC)
  	{
  		echo "<script> 
				alert('Service Sent To Vendor Successfully !!')
				location.replace('sendreceive_vendor.php?menu=".$_GET['menu']."');
			</script>";
  	}
/*$pid = challan_to_id($_POST['challan']);
$ptid = $_POST['prod'];
  $insertSQL = sprintf("INSERT INTO to_vendor (customer_product_id,product_trans_id,vendor_id,to_vendor_challantovendor,remark_to_vendor,purchase_bill_no,purchase_bill_date,to_vendor_send_date) VALUES (%s, %s, %s, %s, %s,%s, %s, %s)",
					   GetSQLValueString($pid, "int"),
					   GetSQLValueString($ptid, "int"),
					   GetSQLValueString($_POST['vendor'], "int"),
					   GetSQLValueString($rece, "text"),
					   GetSQLValueString($_POST['remark'], "text"),
					   GetSQLValueString($_POST['pbill'], "text"),
					   GetSQLValueString($_POST['dpb'], "date"),
					   GetSQLValueString($_POST['spb'], "date"));
  $Result1 = mysql_query($insertSQL) or die(mysql_error());
  if($Result1)
  {
  		echo "<script> 
				alert('Service Sent To Vendor Successfully !!')
				location.replace('sendreceive_vendor.php?menu=".$_GET['menu']."');
			</script>";
  }*/
 }
#############################################################################################



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<link href="style/stylesheet.css" rel="stylesheet" type="text/css">
<link href="style/style.css" rel="stylesheet" type="text/css">
<SCRIPT LANGUAGE="JavaScript">
   
</SCRIPT>

<script language="javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/calendarDateInput.js"></script>
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
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr>
        <td height="35" colspan="2" align="right" class="note" style="padding-right:5px;">* Mandatory Feilds </td>
        </tr>
      <tr>
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_nullV();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
              <td width="22%" height="25" align="right" valign="top">Party Challan Number     </td>
              <td width="3%" align="center" valign="top">:</td>
              <td width="32%" align="left" valign="top" class="pad_l note">
			  <select name="challan" size="10" multiple="multiple" id="challan" onchange="chk_unique()">
			    <option value="0">... Challan No. ...</option>
			  <?php 
			  
			  $chsql = "select a.* from customer_product a order by a.customer_product_received_date desc";
			  $chrec = mysql_query($chsql);
			  while($chres = mysql_fetch_assoc($chrec))
			  {
			  		$cpid = $chres['customer_product_id'];
					$entry = vendor_entry($cpid);
					$p_cnt = prod_cnt($cpid);
					if($entry < $p_cnt)
					{
					
			  ?>
			  <option value="<?php echo $chres['customer_product_receipt_no'];?>"><?php echo $chres['customer_product_receipt_no'];?></option>
			  <?php
			  		}
			  }
			  ?>
			  </select>
 <!--<input name="challan" type="text" id="challan" tabindex="1" />-->
 *</td>
              <td width="15%" align="right" valign="top">Select Product   </td>
              <td width="3%" align="center" valign="top">:</td>
              <td width="25%" align="left" valign="top" class="pad_l note"><div id="areaHint" style="visibility:visible; text-align:left; vertical-align:top"><?php include "chk_unique.php";?></div></td>
			</tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="22%" height="25" align="right">Select Vendor     </td>
              <td width="3%" align="center">:</td>
              <td width="32%" align="left" class="pad_l note"><select name="vendor" id="vendor" tabindex="2">
                <option value="0">... Select ...</option>
                <?php 
				$vsql = mysql_query("select * from vendor_master where vendor_status=1 order by vendor_name");
				while($vres = mysql_fetch_assoc($vsql))
				{
					list($a,$c,$s) = explode("<br>",$vres['vendor_add']);
				?>
                <option value="<?php echo $vres['vendor_id'];?>"><?php echo $vres['vendor_name']." ( ".$c." ) ";?></option>
                <?php
				}
				?>
              </select>                
                *</td>
              <td width="15%" align="right">Purchase Bill Number  </td>
              <td width="3%" align="center">:</td>
              <td width="25%" align="left" class="pad_l note"> <input name="pbill" type="text" id="pbill" /></td>
			</tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="22%" height="25" align="right"> Purchase Date      </td>
              <td width="3%" align="center">:</td>
              <td width="32%" align="left" class="pad_l note"><script>DateInput('dpb', true, 'YYYY-MM-DD')</script><!--<input name="challan" type="text" id="challan" tabindex="1" />-->
                
                </td>
              <td width="15%" align="right">Send Date To Vendor  </td>
              <td width="3%" align="center">&nbsp;</td>
              <td width="25%" align="left" class="pad_l note"><script>DateInput('spb', true, 'YYYY-MM-DD')</script> </td>
			</tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
            
            <tr>
              <td height="10" align="right" valign="top">Any Remark </td>
              <td height="10" align="center" valign="top">:</td>
              <td height="10" colspan="4" align="left" valign="top"><textarea name="remark" cols="100" rows="3" id="remark"></textarea></td>
              </tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="Submit" tabindex="4" /></td>
              <td align="left">&nbsp;</td>
              <td align="left">&nbsp;</td>
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
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" valign="top" bgcolor="#FBFAFA">
	<?php
	if(isset($_POST['key']))
	{
		$query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and ".$_POST['sby']." like '%".$_POST['key']."%' order by to_vendor_send_date desc";
	}else
	{
	 $query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id order by to_vendor_send_date desc";
	 }
	 $query_Recordset1 = "SELECT * from to_vendor group by to_vendor_challantovendor order by to_vendor_send_date desc";
			#echo $query_Recordset1;
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">List of Sent To Vendor </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="5" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form2" name="form2" method="post" action="">
              <table width="75%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="48%" height="30">Search Keyword : 
                    <input name="key" type="text" id="key" size="60" value="<?php echo $_POST['key'];?>" /></td>
                  <td width="28%">Search By : 
                    <select name="sby" id="sby">
                      <option value="to_vendor_challantovendor" <?php if($_POST['sby'] == "to_vendor_challantovendor"){echo "selected";}?>>Vendor Challan Number</option>
					  <option value="customer_product_party_name" <?php if($_POST['sby'] == "customer_product_party_name"){echo "selected";}?>>Party Name</option>
                     <!-- <option value="customer_product_product_name" <?php if($_POST['sby'] == "customer_product_product_name"){echo "selected";}?>>Product Name</option>
                      <option value="customer_product_product_slno" <?php if($_POST['sby'] == "customer_product_product_slno"){echo "selected";}?>>Product Serial Number</option>
                      <option value="customer_product_billno" <?php if($_POST['sby'] == "customer_product_billno"){echo "selected";}?>>Bill Number</option>-->
                      <option value="customer_product_receipt_no" <?php if($_POST['sby'] == "customer_product_receipt_no"){echo "selected";}?>>Party Challan Number</option>
                    </select>                    </td>
                  <td width="24%"><input type="submit" name="Submit2" value="Search" /></td>
                </tr>
              </table>
                        </form>            </td>
          </tr>
          <tr>
            <td height="23" colspan="5" align="center"> <?php
			
				$explodeme2=$pageclassobject->pageprinting($maxRows_rr);
				$strarray2=explode("#",$explodeme2);	
				$startRow_rr=$strarray2[0];
				$numrow_1=$strarray2[1];
		  ?></td>
            </tr>
          <tr class="heading">
            <td width="2%" height="23" align="center">Sl.  </td>
            <td width="29%" align="left">Product Detail </td>
            <td width="31%" align="left">Vendor Bill &amp; Challan Detail </td>
            <td width="15%" align="center">Delivery Status </td>
            <!--            <td width="7%" align="center">Options</td>
-->          </tr>
		 
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
				/*$pt_sql = "select * from product_trans where product_trans_id='$row_Recordset1[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);*/
				
				$prod_name = get_prod($row_Recordset1['to_vendor_challantovendor']);
				$prarr = explode("@@",$prod_name);
				
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <?php
			  for($pr = 0; $pr < count($prarr); $pr++)
			  {
			  ?>
			  <tr>
                <td height="25" align="left"><?php echo $prarr[$pr];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
			  <?php
			  }
              ?>
            </table></td>
            <?php
			  	$all_v = vendor_detail($row_Recordset1['vendor_id']);
				list($a,$b,$c,$d) = explode("#",$all_v);
			  ?>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="66%" height="25" align="left"><b>Vendar  Name : </b><?php echo $a;?></td>
                <td width="34%" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_change.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>&VI=<?php echo $row_Recordset1['vendor_id'];?>','DeliveryWindow','resizable=0,width=450,height=300')">Edit Vendor</a> </td>
              </tr>
			  
              <tr>
                <td height="5" colspan="2" align="left"></td>
              </tr>
              <tr>
                <td height="25" colspan="2" align="left"><b>Contact  No. : </b><?php echo $b;?></td>
              </tr>
              <tr>
                <td height="5" colspan="2" align="left"></td>
              </tr>
              <tr>
                <td height="25" colspan="2" align="left"><b>Email Id. : </b><?php echo $c;?></td>
              </tr>
              <tr>
                <td height="5" colspan="2" align="left"></td>
              </tr>
            </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" align="left"><b>Send Date  : </b><?php echo $row_Recordset1['to_vendor_send_date'];?></td>
                </tr>
                <tr>
                  <td height="5" align="left"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['to_vendor_challantovendor'];?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_challan.php?CP=<?php echo $row_Recordset1['to_vendor_challantovendor'];?>&VI=<?php echo $row_Recordset1['vendor_id'];?>&RM=<?php echo $row_Recordset1['remark_to_vendor'];?>&DT=<?php echo $row_Recordset1['to_vendor_send_date'];?>','PrintWindow','resizable=0,width=850,height=750')" title="Click Here To Print Receipt">Print Challan </a> </td>
                </tr>
              </table></td>
            <td align="center" valign="top">
			<?php if($row_Recordset1['to_vendor_received_date'] == '0000-00-00'){?>
			 <a href="#" onclick="window.open('http://localhost/vohra/receive.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','DeliveryWindow','resizable=0,width=500,height=300')"><img src="images/red.gif" width="24" height="24" border="0" title="Click Here To Receive From Vendor" /></a><br /><br />Sent To Vendor & Not Received From Vendor<br />
			<?php }else{?>
			<img src="images/green.gif" width="24" height="24" title="Delivered" /><br /><br />Received From Vendor on <?php echo $row_Recordset1['to_vendor_received_date'];?><br /><textarea name="" cols="" rows=""><?php echo $row_Recordset1['to_vendor_remark'];?></textarea>
			<?php }?></td>
            <!--<td align="center" valign="top"><?php if($AE == 1){?><a href="saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&D')"> Delete</a><?php }?> </td>-->
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
