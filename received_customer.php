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

  if($_POST['type'] == "w")
  {
  		$type = "Warranty";
		$all = $_POST['alltype'];
		$oth = $_POST['other_val'];
		#echo "ALL : ".$all."<br>OTH : ".$oth;
		if($all && $oth)
		{
			$took = $all.",".$oth;
		}elseif($all && !oth)
		{
			$took = $all;
		}elseif(!$all && $oth)
		{
			$took = $oth;
		}else
		{
			$took = "";
		}
		$pr = "";
		#echo "<br>TOOK : ".$took;
  }else
  {
  		$type = "Non Warranty";
		$pr = $_POST['ep'];
		$took = "";
  }
  $dr = $_POST['dr'];
  $tod = $dr;
  $sql = "select * from customer_product where customer_product_received_date='$tod'";
#echo $sql."<br	>";
$rec = mysql_query($sql);
$num = mysql_num_rows($rec);
$num = $num+1;

list($yy,$mm,$dd) = explode("-",$dr);
$rece = "C".$yy.$mm.$dd.$num;
#echo $rece;exit;
  $insertSQL = sprintf("INSERT INTO customer_product (customer_product_party_name,customer_product_party_contact,customer_product_paradd,customer_product_paremail,customer_product_warrenty,customer_product_estemated_price,customer_product_acce,customer_product_prob,customer_product_receipt_no,customer_product_received_date) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
					   
					   GetSQLValueString($_POST['par_name'], "text"),
					   GetSQLValueString($_POST['par_contno'], "text"),
					   GetSQLValueString($_POST['add'], "text"),
					   GetSQLValueString($_POST['email'], "text"),
					   GetSQLValueString($type, "text"),
					   GetSQLValueString($pr, "text"),
					   GetSQLValueString($took, "text"),
					   GetSQLValueString($_POST['prob'], "text"),
					   GetSQLValueString($rece, "text"),
					   GetSQLValueString($_POST['dr'], "date"));
					   #echo $insertSQL;exit;
  $Result1 = mysql_query($insertSQL) or die(mysql_error());
  $lid = mysql_insert_id();
  for($p = 1; $p <= 5; $p++)
  {
  	$pname = $_POST['pro_name'.$p];
	$psl = $_POST['pro_slno'.$p];
	$pbill = $_POST['bill_no'.$p];
	$pbdt = $_POST['dob'.$p];
	if($pname)
	{
		$trans_sql = "insert into product_trans(product_master_id,product_name,product_sl_no,product_bill_dt,product_bill_no) values('$lid','$pname','$psl','$pbdt','$pbill')";
		$trans_rec = mysql_query($trans_sql);
	}
  }
  if($Result1)
  {
  		echo "<script>
				alert('Service Data Added Successfully !!')
				location.replace('received_customer.php?menu=".$_GET['menu']."');
			</script>";
  }
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
    <td align="left" valign="top" bgcolor="#FBFAFA"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0" class="tabsborder2">
      <tr>
        <td height="35" colspan="2" align="right" class="note" style="padding-right:5px;">* Mandatory Feilds </td>
        </tr>
      <tr>
        
        <td height="120" colspan="2" align="center" valign="middle" class="mostbtext"><form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return chk_nullS();">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
              <td width="22%" height="25" align="right">Party Name      </td>
              <td width="3%" align="center">:</td>
              <td align="left" class="pad_l note">
 <input name="par_name" type="text" id="par_name" tabindex="1" />
 *</td>
              <td align="right">Party Contact Number </td>
              <td align="center">:</td>
              <td align="left" class="pad_l note"><input name="par_contno" type="text" id="par_contno" tabindex="2" onkeypress="{if((event.keyCode&lt;48) ||(event.keyCode&gt;57)){event.returnValue=false;}}" />
                *</td>
			</tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			<tr>
              <td width="22%" height="25" align="right" valign="top">Party Address      </td>
              <td width="3%" align="center" valign="top">:</td>
              <td align="left" class="pad_l note" valign="top">
               
<textarea name="add" cols="35" rows="4" id="add" tabindex="3" style="overflow:hidden"></textarea></td>
              <td align="right" valign="top">Email Address Of Party </td>
              <td align="center" valign="top">:</td>
              <td align="left" class="pad_l note" valign="top"><input name="email" type="text" id="email" tabindex="4" /></td>
			</tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			<?php
			$t = 5;
			for($p = 1; $p <= 5; $p++)
			{

			?>
            <tr>
              <td width="22%" height="25" align="right">Product Name - ( <?php echo $p;?> )   </td>
              <td width="3%" align="center">:</td>
              <td width="25%" align="left" class="pad_l note">
               
<input name="pro_name<?php echo $p;?>" type="text" id="pro_name<?php echo $p;?>" tabindex="<?php echo $t; $t++;?>" />
*</td>
              <td width="21%" align="right">Product Sl. No. - ( <?php echo $p;?> ) </td>
              <td width="4%" align="center">:</td>
              <td width="25%" align="left" class="pad_l note"><input name="pro_slno<?php echo $p;?>" type="text" id="pro_slno<?php echo $p;?>" tabindex="<?php echo $t; $t++;?>" />
                *</td>
            </tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			
			
			 <tr>
              <td width="22%" height="25" align="right">Product Bill Number - ( <?php echo $p;?> )      </td>
              <td width="3%" align="center">:</td>
              <td align="left" class="pad_l note">
                <input name="bill_no<?php echo $p;?>" type="text" id="bill_no<?php echo $p;?>" tabindex="<?php echo $t; $t++;?>" onkeypress="{if((event.keyCode&lt;48) ||(event.keyCode&gt;57)){event.returnValue=false;}}" /></td>
              <td align="right">Product Bill Date - ( <?php echo $p;?> ) </td>
              <td align="center">:</td>
              <td align="left" class="pad_l note"><script>DateInput('dob<?php echo $p;?>', true, 'YYYY-MM-DD')</script></td>
			 </tr>
			<tr>
              <td colspan="6" align="right"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="10" style="border-bottom:solid 1px #000000">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
			<?php
			}
			?>
			 <tr>
              <td width="22%" height="25" align="right">Received Date </td>
              <td width="3%" align="center">:</td>
              <td align="left" class="pad_l note"><script>DateInput('dr', true, 'YYYY-MM-DD')</script></td>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left" class="pad_l note">&nbsp;</td>
			 </tr>
			<tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
			
            <tr>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td align="center">Warrenty
                <input name="type" type="radio" value="w" onclick="showhide('war','nwar');" tabindex="11" /></td>
              <td align="center">Non-Warrenty
               
                  <input name="type" type="radio" value="n" onclick="showhide('nwar','war');" tabindex="12" /></td>
              <td align="right">&nbsp;</td>
              <td align="right">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
            <tr>
              <td colspan="6" align="center" height="10"><table width="75%" border="0" cellpadding="0" cellspacing="0" id="war" style="border:1px solid #000000; display:none;">
                <tr>
                  <td width="25%" height="30" align="center"><label>
                    <input name="adaptor" type="checkbox" id="adaptor" value="Adaptor" tabindex="13" onclick="take()" />
                    Adaptor</label></td>
                  <td width="25%" align="center"><input name="memory_card" type="checkbox" id="memory_card" value="Memory card" tabindex="14" onclick="take()" /> 
                    Memory Card</td>
                  <td width="25%" align="center"><input name="vga" type="checkbox" id="vga" value="VGA Card" tabindex="15" onclick="take()" /> 
                    VGA Card</td>
                  <td width="25%" align="center"><input name="sound_card" type="checkbox" id="sound_card" value="Sound Card" tabindex="16" onclick="take()" /> 
                    Sound Card</td>
                </tr>
                <tr>
                  <td height="30" align="center"><input name="tv_tuner" type="checkbox" id="tv_tuner" value="TV Tuner" tabindex="17" onclick="take()" /> 
                    TV Tuner</td>
                  <td align="center"><input name="modem" type="checkbox" id="modem" value="Modem" tabindex="18" onclick="take()" /> 
                    Modem</td>
                  <td align="center"><input name="lan" type="checkbox" id="lan" value="LAN Card" tabindex="19" onclick="take()" />
                    LAN Card </td>
                  <td align="center"><input name="others" type="checkbox" id="others" value="O" onclick="chk_showhide('others','oval')" tabindex="20" />
Others </td>
                </tr>
                <tr>
                  <td height="30" align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center"><input name="alltype" type="hidden" id="alltype" /></td>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="oval" style="display:none;">
                    <tr>
                      <td><textarea name="other_val" cols="50" rows="4" id="other_val" style="overflow:hidden" tabindex="21"></textarea></td>
                    </tr>
                  </table></td>
                </tr>
              </table>
                <table width="35%" border="0" cellpadding="0" cellspacing="0" id="nwar" style="border:1px solid #000000; display:none;">
                  <tr>
                    <td width="38%" height="25" class="paddL">Estemated Price : </td>
                    <td width="62%"><input name="ep" type="text" id="ep" tabindex="13" /><span class="note">*</span></td>
                  </tr>
                </table>               </td>
            </tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="10" align="right" valign="top">Problem In Brief </td>
              <td height="10" align="center" valign="top">:</td>
              <td height="10" colspan="4" align="left" valign="top"><textarea name="prob" cols="100" rows="5" id="prob"></textarea></td>
              </tr>
            <tr>
              <td colspan="6" align="right" height="10"></td>
            </tr>
            <tr>
              <td height="25" align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left">&nbsp;</td>
              <td align="left"><input type="submit" name="Submit" value="Submit" /></td>
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
		$query_Recordset1 = "SELECT * from customer_product where ".$_POST['sby']." like '%".$_POST['key']."%' order by customer_product_received_date desc";
	}else
	{
	 $query_Recordset1 = "SELECT * from customer_product order by customer_product_received_date desc";
	 }
			#echo $query_Recordset1;
			$pageclassobject = new pageclass;
			$query_limit_sql = $query_Recordset1;
			// using function paging($sql_1) of class pageclass to get limit of max rows on one page
			$query_limit_rr=$pageclassobject->paging($query_limit_sql,$maxRows_rr);
			#echo $query_limit_rr;
			$Records1 = mysql_query($query_limit_rr);
			
			$totalRows_Recordset1 = mysql_num_rows($Records1);
			if($totalRows_Recordset1 > 0)
			{
			
  ?>
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">List of Service Entry </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form2" name="form2" method="post" action="">
              <table width="75%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="48%" height="30">Search Keyword : 
                    <input name="key" type="text" id="key" size="60" value="<?php echo $_POST['key'];?>" /></td>
                  <td width="28%">Search By : 
                    <select name="sby" id="sby">
                      <option value="customer_product_party_name" <?php if($_POST['sby'] == "customer_product_party_name"){echo "selected";}?>>Party Name</option>
                      <!--<option value="customer_product_name" <?php if($_POST['sby'] == "customer_product_name"){echo "selected";}?>>Product Name</option>
                      <option value="customer_product_slno" <?php if($_POST['sby'] == "customer_product_slno"){echo "selected";}?>>Product Serial Number</option>-->
					  <option value="customer_product_received_date" <?php if($_POST['sby'] == "customer_product_received_date"){echo "selected";}?>>Received Date</option>
                      <!--<option value="customer_product_billno" <?php if($_POST['sby'] == "customer_product_billno"){echo "selected";}?>>Bill Number</option>-->
                      <option value="customer_product_receipt_no" <?php if($_POST['sby'] == "customer_product_receipt_no"){echo "selected";}?>>Challan Number</option>
                    </select>
                    </td>
                  <td width="24%"><input type="submit" name="Submit2" value="Search" /></td>
                </tr>
              </table>
                        </form>
            </td>
          </tr>
          <tr>
            <td height="23" colspan="6" align="center"> <?php
			
				$explodeme2=$pageclassobject->pageprinting($maxRows_rr);
				$strarray2=explode("#",$explodeme2);	
				$startRow_rr=$strarray2[0];
				$numrow_1=$strarray2[1];
		  ?></td>
            </tr>
          <tr class="heading">
            <td width="3%" height="23" align="center">Sl.  </td>
            <td width="32%" align="left">Product Detail </td>
            <td width="20%" align="left">Party  Detail  </td>
            <td width="25%" align="left">Bill &amp; Challan Detail </td>
             <!-- <td width="15%" align="center">Delivery Status </td>
                      <td width="7%" align="center">Options</td>
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
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php
			$sx = 1;
			$tsql = mysql_query("select * from product_trans where product_master_id='$row_Recordset1[customer_product_id]'");
			while($tres = mysql_fetch_assoc($tsql))
			{
				$rdt_nsl = rec_dt($tres['product_trans_id']);
				list($rdt,$nsl) = explode("##",$rdt_nsl);
			?>
              <tr>
                <td height="25" align="left"><b>(<?php echo $sx;?>) Prod. Name : </b><?php echo $tres['product_name'];?></td>
                <td height="25" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td width="60%" height="25" align="left"><b>(<?php echo $sx;?>) Serial No. : </b><?php echo $tres['product_sl_no'];?></td>
                <?php
					$vs = vendor_status($tres['product_trans_id'])
				?>
				<td width="42%" align="center" class="note"><?php if($vs == 1){?><img src="images/red.gif" width="24" height="24" /><br />
				  Not Sent To Vendor<?php }elseif($vs == 2){?><img src="images/yellow.gif" width="24" height="24" /><br />Sent To Vendor<?php }elseif($vs == 3){?> 
				  <?php
				  	if($tres['customer_product_delivery_date'] == "0000-00-00" || $tres['customer_product_delivery_date'] == "")
					{
				  ?>
				  <a href="#" onclick="window.open('http://localhost/vohra/delivery.php?CP=<?php echo $tres['product_trans_id'];?>','DeliveryWindow','resizable=0,width=450,height=300')"><img src="images/green.gif" width="24" height="24" border="0" title="Click Here For Delivery" /></a>
				  <?php 
				  	}else
					{
				  ?>
				  	<img src="images/green.gif" width="24" height="24" />
					<?php
					}
					?>
				  <br />
				  Received From Vendor. <br>Dt. : <?php echo $rdt; if($nsl){echo "<br>New Sl. No. : <b>".$nsl."</b>";} }?>
				  <?php
				  	if($tres['customer_product_delivery_date'] != "0000-00-00" )
					{
						$dd = 1;
				  ?>
				  <br />
				  	<br />Delivered<br /><textarea name="" cols="" rows=""><?php echo $tres['remark'];?></textarea>
				  <?php
				  	}
				  ?>
				  </td>
              </tr>
			  <tr>
                <td height="10" colspan="2" align="left" background="images/ln.jpg"></td>
              </tr>
			 <?php
			 $sx++;
			 }
			 ?>
			 <?php
				if($dd == 1)
				{
				?>
              <tr>
                <td height="25" colspan="2" align="center">
				
						<a href="#" onclick="window.open('http://localhost/vohra/delivery_receipt.php?CP=<?php echo $row_Recordset1['customer_product_id'];?>','PrintWindow','resizable=1,scrollbars=1,width=850,height=550')" title="Click Here To Print Delivery Receipt">Delivery Receipt</a>				</td>
              </tr>
			  <?php 
			  }else
			  {
			  ?>
			  <tr>
                <td height="25" colspan="2" align="center">
				
						<a href="#" onclick="alert('Challan <?php echo $row_Recordset1['customer_product_receipt_no'];?> Is Not Delivered Yet'); return false;" title="Click Here To Print Delivery Receipt">Delivery Receipt</a>				</td>
              </tr>
			  <?php
			  }
			  ?>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Party Name : </b><?php echo $row_Recordset1['customer_product_party_name'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $row_Recordset1['customer_product_party_contact'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php if($row_Recordset1['customer_product_paremail']){echo $row_Recordset1['customer_product_paremail'];}else{echo "Not Available.";}?></td>
              </tr>
              <tr>
                <td height="" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Received Date : </b><?php echo $row_Recordset1['customer_product_received_date'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/party_change.php?PN=<?php echo $row_Recordset1['customer_product_party_name'];?>&PC=<?php echo $row_Recordset1['customer_product_party_contact'];?>&PE=<?php echo $row_Recordset1['customer_product_paremail'];?>&CR=<?php echo $row_Recordset1['customer_product_id'];?>','DeliveryWindow','resizable=0,width=450,height=300')">Edit Party Detail</a> </td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			<?php
			$tsql = mysql_query("select * from product_trans where product_master_id='$row_Recordset1[customer_product_id]'");
			$xs = 1;
			while($tres = mysql_fetch_assoc($tsql))
			{
			?>
              <tr>
                <td height="25" align="left"><b>(<?php echo $xs;?>) Bill No. / Date  : </b><?php echo $tres['product_bill_no'];?> / <?php echo $tres['product_bill_dt'];?></td>
              </tr>
              <tr>
                <td height="10" align="left" background="images/ln.jpg"></td>
              </tr>
			  <?php 
			  $xs++;
			  }
			  ?>
			  <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['customer_product_receipt_no'];?></td>
              </tr>
              <tr>
               <td height="10"></td>
              </tr>
              <tr>
                <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/print_receipt.php?CP=<?php echo $row_Recordset1['customer_product_id'];?>','PrintWindow','resizable=1,scrollbars=1,width=850,height=550')" title="Click Here To Print Receipt">Print Receipt</a> </td>
              </tr>
            </table></td>
            <!--<td align="center" valign="top">
			<?php if($row_Recordset1['customer_product_delivery_date'] == '0000-00-00')
			{
				$lnk = vendor_receive($row_Recordset1['customer_product_id']);
				#echo "Avijit : ".$lnk;
				if($lnk == 2)
				{
			?>
			 <a href="#" onclick="window.open('http://localhost/vohra/delivery.php?CP=<?php echo $row_Recordset1['customer_product_id'];?>','DeliveryWindow','resizable=0,width=450,height=300')"><img src="images/yellow.gif" width="24" height="24" border="0" title="Click Here To Deliver" /></a><br /><br />Received Fron Vendor But Not Delivered<br />
			<?php 
				}else
				{
			?>
			<img src="images/red.gif" width="24" height="24" border="0" /></a><br /><br />Not Delivered<br />
			<?php	
				}
				
			}else{?>
			<img src="images/green.gif" width="24" height="24" title="Delivered" /><br /><br />Delivered<br /><textarea name="" cols="" rows=""><?php echo $row_Recordset1['remark'];?></textarea>
			<?php }?></td>
            <!--<td align="center" valign="top"><?php if($AE == 1){?><a href="saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&D')"> Delete</a><?php }?> </td>
            </tr>
		  
        </table></td>--><?php
		  	$i++;
		  }
		  ?>
      </tr>
      <tr>
        <td height="20" colspan="4">&nbsp;</td>
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
