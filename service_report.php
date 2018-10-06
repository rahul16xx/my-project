<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");
if(!isset($_GET['ch']))
{
	echo "<script>
			location.replace('service_report.php?menu=$_GET[menu]&ch=rfc');
		</script>"; ///////////////// Added on 19.10.2009 by Avijit Datta
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
\
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
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FBFAFA" class="mostbbtext"><form id="form1" name="form1" method="post" action="">
      <table width="85%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">Received From Customer
            <input name="ch" id="ch" type="radio" value="rfc" <?php if(!isset($_GET['ch']) || $_GET['ch'] == "rfc"){echo "checked";}?> onclick="get_det('<?php echo $_GET['menu'];?>')" /></td>
          <td align="center">Sent To Vendor
            <input name="ch" id="ch" type="radio" value="stv" <?php if($_GET['ch'] == "stv"){echo "checked";}?> onclick="get_det('<?php echo $_GET['menu'];?>')" /></td>
          <td align="center">Received From Vendor
            <input name="ch" id="ch" type="radio" value="rfv" <?php if($_GET['ch'] == "rfv"){echo "checked";}?> onclick="get_det('<?php echo $_GET['menu'];?>')" /></td>
          <td align="center">Pending From Vendor
            <input name="ch" id="ch" type="radio" value="pfv" <?php if($_GET['ch'] == "pfv"){echo "checked";}?> onclick="get_det('<?php echo $_GET['menu'];?>')" /></td>
          <td align="center">Delivered
            <input name="ch" id="ch" type="radio" value="nstv" <?php if($_GET['ch'] == "nstv"){echo "checked";}?> onclick="get_det('<?php echo $_GET['menu'];?>')" /></td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#FBFAFA">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" valign="top" bgcolor="#FBFAFA">
	
	<?php
	if(!isset($_GET['ch']) || $_GET['ch'] == "rfc")
	{
		if(isset($_POST['key']))
		{
			$query_Recordset1 = "SELECT * from customer_product where ".$_POST['sby']." like '%".$_POST['key']."%' order by customer_product_received_date asc";
		}else
		{
		 $query_Recordset1 = "SELECT * from customer_product order by customer_product_received_date asc";
		 }
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">Received From Customer List  </td>
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
				  Not Sent To Vendor<?php }elseif($vs == 2){?><img src="images/yellow.gif" width="24" height="24" /><br />Sent To Vendor<?php }elseif($vs == 3){?><img src="images/green.gif" width="24" height="24" /><br />Received From Vendor. <br>Dt. : <?php echo $rdt; if($nsl){echo "<br>New Sl. No. : <b>".$nsl."</b>";} }?>
				  <?php
				  	if($tres['customer_product_delivery_date'] != "0000-00-00" )
					{
						$dd = 1;
				  ?>
				  <br />
				  	<br /><b>Delivered</b><br /><textarea name="" cols="" rows=""><?php echo $tres['remark'];?></textarea>
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
              <tr>
                <td height="25" colspan="2" align="left">&nbsp;</td>
              </tr>
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
			<?php /*if($row_Recordset1['customer_product_delivery_date'] == '0000-00-00')
			{
				$lnk = vendor_receive($row_Recordset1['customer_product_id']);
				#echo "Avijit : ".$lnk;*/
				if($vs == 2)
				{
			?>
			 <img src="images/yellow.gif" width="24" height="24" border="0" title="Click Here To Deliver" /><br /><br />Received Fron Vendor But Not Delivered<br />
			<?php 
				}elseif($vs == 1)
				{
			?>
			<img src="images/red.gif" width="24" height="24" border="0" /></a><br /><br />Not Delivered<br />
			<?php	
				}
				
			else{?>
			<img src="images/green.gif" width="24" height="24" title="Delivered" /><br /><br />Delivered<br /><textarea name="" cols="" rows=""><?php echo $row_Recordset1['remark'];?></textarea>
			<?php }?></td>
            <td align="center" valign="top"><?php if($AE == 1){?><a href="saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&D')"> Delete</a><?php }?> </td>-->
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
	 }elseif($_GET['ch'] == "stv")
	 {
		if(isset($_POST['key']))
		{
			$query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and ".$_POST['sby']." like '%".$_POST['key']."%' order by to_vendor_send_date desc";
		}else
		{
		 $query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id order by to_vendor_send_date desc";
		 }
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">Sent To Vendor List </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form3" name="form3" method="post" action="">
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
            <td width="18%" align="left">Product Detail </td>
            <td width="31%" align="left">Party Bill &amp; Challan Detail  </td>
            <td width="36%" align="left">Vendor Bill &amp; Challan Detail </td>
            <td width="12%" align="center">Status </td>
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
				$pt_sql = "select * from product_trans where product_trans_id='$row_Recordset1[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);
				
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Product Name : </b><?php echo $pt_res['product_name'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Serial No. : </b><?php echo $pt_res['product_sl_no'];?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Party Name : </b><?php echo $row_Recordset1['customer_product_party_name'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $row_Recordset1['customer_product_party_contact'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $row_Recordset1['customer_product_paremail'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
            </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" align="left"><b>Bill No. / Date  : </b><?php echo $pt_res['product_bill_no'];?> / <?php echo $pt_res['product_bill_dt'];?></td>
                </tr>
                <tr>
                  <td height="5" align="left"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['customer_product_receipt_no'];?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Receive Date : </b><?php echo $row_Recordset1['customer_product_received_date'];?></td>
                </tr>
              </table></td>
			  <?php
			  	$all_v = vendor_detail($row_Recordset1['vendor_id']);
				list($a,$b,$c,$d) = explode("#",$all_v);
			  ?>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Vendar  Name : </b><?php echo $a;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $b;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $c;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
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
                  <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_challan.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','PrintWindow','resizable=0,width=850,height=750')" title="Click Here To Print Receipt">Print Challan </a> </td>
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
	   }else
	   {
	   		echo "No Record Found";
	   }
	 }elseif($_GET['ch'] == "rfv")
	 {
		if(isset($_POST['key']))
		{
			$query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and to_vendor_received_date!='0000-00-00' and ".$_POST['sby']." like '%".$_POST['key']."%' order by to_vendor_send_date desc";
		}else
		{
		 $query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and to_vendor_received_date!='0000-00-00' order by to_vendor_send_date desc";
		 }
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">Received From  Vendor List </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form4" name="form4" method="post" action="">
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
            <td width="18%" align="left">Product Detail </td>
            <td width="31%" align="left">Party Bill &amp; Challan Detail  </td>
            <td width="36%" align="left">Vendor Bill &amp; Challan Detail </td>
            <td width="12%" align="center">Status </td>
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
				$pt_sql = "select * from product_trans where product_trans_id='$row_Recordset1[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);
				
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Product Name : </b><?php echo $pt_res['product_name'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Serial No. : </b><?php echo $pt_res['product_sl_no'];?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Party Name : </b><?php echo $row_Recordset1['customer_product_party_name'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $row_Recordset1['customer_product_party_contact'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $row_Recordset1['customer_product_paremail'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
            </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" align="left"><b>Bill No. / Date  : </b><?php echo $pt_res['product_bill_no'];?> / <?php echo $pt_res['product_bill_dt'];?></td>
                </tr>
                <tr>
                  <td height="5" align="left"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['customer_product_receipt_no'];?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Receive Date : </b><?php echo $row_Recordset1['customer_product_received_date'];?></td>
                </tr>
              </table></td>
			  <?php
			  	$all_v = vendor_detail($row_Recordset1['vendor_id']);
				list($a,$b,$c,$d) = explode("#",$all_v);
			  ?>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Vendar  Name : </b><?php echo $a;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $b;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $c;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
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
                  <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_challan.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','PrintWindow','resizable=0,width=850,height=750')" title="Click Here To Print Receipt">Print Challan </a> </td>
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
	  	}else
		{
			echo "No Record Found";
		}
	 }elseif($_GET['ch'] == "pfv")
	 {
		if(isset($_POST['key']))
		{
			$query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and to_vendor_received_date='0000-00-00' and ".$_POST['sby']." like '%".$_POST['key']."%' order by to_vendor_send_date desc";
		}else
		{
		 $query_Recordset1 = "SELECT * from to_vendor v,customer_product cp where v.customer_product_id=cp.customer_product_id and to_vendor_received_date='0000-00-00' order by to_vendor_send_date desc";
		 }
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">Pending From Vendor List </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form5" name="form5" method="post" action="">
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
            <td width="18%" align="left">Product Detail </td>
            <td width="31%" align="left">Party Bill &amp; Challan Detail  </td>
            <td width="36%" align="left">Vendor Bill &amp; Challan Detail </td>
            <td width="12%" align="center">Status </td>
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
				$pt_sql = "select * from product_trans where product_trans_id='$row_Recordset1[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);
				
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Product Name : </b><?php echo $pt_res['product_name'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Serial No. : </b><?php echo $pt_res['product_sl_no'];?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Party Name : </b><?php echo $row_Recordset1['customer_product_party_name'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $row_Recordset1['customer_product_party_contact'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $row_Recordset1['customer_product_paremail'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
            </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" align="left"><b>Bill No. / Date  : </b><?php echo $pt_res['product_bill_no'];?> / <?php echo $pt_res['product_bill_dt'];?></td>
                </tr>
                <tr>
                  <td height="5" align="left"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['customer_product_receipt_no'];?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Receive Date : </b><?php echo $row_Recordset1['customer_product_received_date'];?></td>
                </tr>
              </table></td>
			  <?php
			  	$all_v = vendor_detail($row_Recordset1['vendor_id']);
				list($a,$b,$c,$d) = explode("#",$all_v);
			  ?>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Vendar  Name : </b><?php echo $a;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $b;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $c;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
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
                  <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_challan.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','PrintWindow','resizable=0,width=850,height=750')" title="Click Here To Print Receipt">Print Challan </a> </td>
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
	 	 }else
		 {
		 	echo "No Record Found";
		 }
	 }elseif($_GET['ch'] == "nstv")
	 {
		if(isset($_POST['key']))
	{
		$query_Recordset1 = "SELECT cp.*,tv.*,pt.* from customer_product cp, to_vendor tv,product_trans pt where cp.customer_product_id=tv.customer_product_id and pt.customer_product_delivery_date!='0000-00-00' and cp.customer_product_id=pt.product_master_id and ".$_POST['sby']." like '%".$_POST['key']."%' order by customer_product_received_date desc";
	}else
	{
	 $query_Recordset1 = "SELECT cp.*,tv.*,pt.* from customer_product cp, to_vendor tv,product_trans pt where cp.customer_product_id=tv.customer_product_id and cp.customer_product_id=pt.product_master_id and pt.customer_product_delivery_date!='0000-00-00' order by customer_product_received_date desc";
	 }
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
        <td height="35" colspan="2" align="left" class="mostbbtext" style="padding-left:5px;">Delivered Detail   </td>
      </tr>
	  <tr>
                <td colspan="3" align="right" height="10"></td>
              </tr>
	
        <td height="120" colspan="2" align="center" valign="middle" class="mosttext"><table width="99%" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <td height="23" colspan="6" align="center" class="mostbbtext" style="border-bottom:1px solid #000000"><form id="form6" name="form6" method="post" action="">
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
            <td width="18%" align="left">Product Detail </td>
            <td width="31%" align="left">Party Bill &amp; Challan Detail  </td>
            <td width="36%" align="left">Vendor Bill &amp; Challan Detail </td>
            <td width="12%" align="center">Delivery Status </td>
            <!--            <td width="7%" align="center">Options</td>
-->          </tr>
		 
		  <?php
		  $i=1;
		  while($row_Recordset1 = mysql_fetch_assoc($Records1))
		  {
		  	if($row_Recordset1['customer_product_delivery_date'] != '0000-00-00')
			{
			if($i%2 == 0)
			{
				echo "<tr bgcolor=#D7D3D9>";
			}else
			{
				echo "<tr bgcolor=#ECEAED>";
			}
				$pt_sql = "select * from product_trans where product_trans_id='$row_Recordset1[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);
				
		  ?>
          
            <td height="23" align="center" valign="top"><?php echo $i?></td>
            <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Product Name : </b><?php echo $pt_res['product_name'];?></td>
              </tr>
              <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Serial No. : </b><?php echo $pt_res['product_sl_no'];?></td>
              </tr>
			  <tr>
                <td height="10" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>New Sl. No. : </b><em><?php echo $row_Recordset1['to_vendor_new_slno'];?></em></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Party Name : </b><?php echo $row_Recordset1['customer_product_party_name'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $row_Recordset1['customer_product_party_contact'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $row_Recordset1['customer_product_paremail'];?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
            </table>
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="25" align="left"><b>Bill No. / Date  : </b><?php echo $pt_res['product_bill_no'];?> / <?php echo $pt_res['product_bill_dt'];?></td>
                </tr>
                <tr>
                  <td height="5" align="left"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Challan No. : </b><?php echo $row_Recordset1['customer_product_receipt_no'];?></td>
                </tr>
                <tr>
                  <td height="5"></td>
                </tr>
                <tr>
                  <td height="25" align="left"><b>Receive Date : </b><?php echo $row_Recordset1['customer_product_received_date'];?></td>
                </tr>
              </table></td>
			  <?php
			  	$all_v = vendor_detail($row_Recordset1['vendor_id']);
				list($a,$b,$c,$d) = explode("#",$all_v);
			  ?>
            <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td height="25" align="left"><b>Vendar  Name : </b><?php echo $a;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Contact  No. : </b><?php echo $b;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
              </tr>
              <tr>
                <td height="25" align="left"><b>Email Id. : </b><?php echo $c;?></td>
              </tr>
              <tr>
                <td height="5" align="left"></td>
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
                  <td height="25" align="center"><a href="#" onclick="window.open('http://localhost/vohra/vendor_challan.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','PrintWindow','resizable=0,width=850,height=750')" title="Click Here To Print Receipt">Print Challan </a> </td>
                </tr>
              </table></td>
            <td align="center" valign="top">
			<?php if($row_Recordset1['customer_product_delivery_date'] == '0000-00-00'){?>
			 <a href="#" onclick="window.open('http://localhost/vohra/receive.php?CP=<?php echo $row_Recordset1['to_vendor_id'];?>','DeliveryWindow','resizable=0,width=500,height=300')"><img src="images/red.gif" width="24" height="24" border="0" title="Click Here To Receive From Vendor" /></a><br /><br />Sent To Vendor & Not Received From Vendor<br />
			<?php }else{?>
			<img src="images/green.gif" width="24" height="24" title="Delivered" /><br /><br />Delivered on <?php echo $row_Recordset1['customer_product_delivery_date'];?><br /><textarea name="" cols="" rows=""><?php echo $row_Recordset1['remark'];?></textarea>
			<?php }?></td>
            <!--<td align="center" valign="top"><?php if($AE == 1){?><a href="saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&E" class="mosttext">Edit</a> |<?php }if($AD == 1){?><a href="#" class="mosttext" onclick="conf('saving_account.php?menu=<?php echo $_GET['menu'];?>&I=<?php echo $row_Recordset1['saving_acc_master_id'];?>&D')"> Delete</a><?php }?> </td>-->
            </tr>
		  <?php
		  	$i++;
		  }
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
