<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include_once("connection/adsmedia.php");
include "includes/functions.php";


$sql2 = "select * from customer_product where customer_product_id='$_GET[CP]'";
$rec2 = mysql_query($sql2);
$res2 = mysql_fetch_assoc($rec2);
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
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA" style="border:1px solid #000000" onclick="window.print()" title="Click To Print">
  <tr>
    <td width="41%" height="112" align="center" style="border-bottom:1px solid #000000" class="mosttext"><p><img src="images/Vohra_brothers_vector.jpg" width="420" height="96" /></p>
    <p>Guruaastha Building, Behind Axis Bank, Punjabipara, Sevoke Road, Siliguri - 01 </p></td>
    <td width="59%" align="right" valign="bottom" style="border-bottom:1px solid #000000" class="mostbtext paddR"><p>Phone : 0353-2642547</p>
    <p>Email : vohrabros@gmail.com </p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
	</tr>
      <tr>
        <td height="30" colspan="4" align="left" class="mostbbtext paddL" style="border-bottom:1px solid #000000"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="49%"><span class="mostbbtext paddL" style="border-bottom:1px solid #000000"><!--Receipt No  : <span class="mosttext"><?php echo $res2['customer_product_receipt_no'];?>--></span></span></td>
            <td width="51%" align="right"><span class="mostbbtext paddL" style="border-bottom:1px solid #000000"><b>Date : <?php echo date('d-m-Y');?></b></span></td>
          </tr>
        </table></td>
        <td align="right" class="paddR note" style="border-bottom:1px solid #000000">&nbsp;</td>
      </tr>
      <tr>
        <td width="14%" height="25" align="right">&nbsp;</td>
        <td width="31%" align="left" class="pad_l note">&nbsp;</td>
        <td width="17%" align="right">&nbsp;</td>
        <td width="36%" align="left" class="pad_l note">&nbsp;</td>
        <td width="2%" rowspan="20" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
	  <tr>
        <td height="35" align="right" valign="bottom" class="mostbtext paddR">Party Name </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $res2['customer_product_party_name'];?></td>
        <td align="right" valign="bottom" class="mostbtext paddR">Party Address </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $res2['customer_product_paradd'];?></td>
        </tr>
     
      <tr>
        <td height="35" align="right" valign="bottom" class="mostbtext paddR"> Contact No. </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $res2['customer_product_party_contact'];?></td>
        <td align="right" valign="bottom" class="mostbtext paddR">Email Address </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php if($res2['customer_product_paremail']){echo $res2['customer_product_paremail'];}else{echo "NA";}?></td>
      </tr>
	  <?php 
	  	$cpid = $res2['customer_product_id'];
		$tsql = "select * from product_trans where product_master_id='$cpid' and customer_product_delivery_date<>'0000-00-00'";
		$trec = mysql_query($tsql);
		$xx = 1;
		while($tres = mysql_fetch_assoc($trec))
		{
			$rdt_nsl = rec_dt($tres['product_trans_id']);
			list($rdt,$nsl) = explode("##",$rdt_nsl);
	  ?>
      <tr>
        <td width="14%" height="35" align="right" valign="bottom" class="mostbtext paddR">Product - ( <?php echo $xx;?> )</td>
        <td width="31%" align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $tres['product_name'];?></td>
        <td width="17%" align="right" valign="bottom" class="mostbtext paddR">Old/<em>New</em> Sl. No. - ( <?php echo $xx;?> ) </td>
        <td width="36%" align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $tres['product_sl_no'];?> / <b><em><?php echo $nsl;?><em></b></td>
        </tr>
     
      
      <tr>
        <td height="35" align="right" valign="bottom" class="mostbtext paddR"> Bill No./Dt.- ( <?php echo $xx;?> ) </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $tres['product_bill_no'];?> / <?php echo $tres['product_bill_dt'];?></td>
        <td align="right" valign="bottom" class="mostbtext paddR"> Remark - ( <?php echo $xx;?> ) </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $tres['remark'];?></td>
        </tr>
      <?php 
	  $xx++;
	  }
	  ?>
      <tr>
        <td height="35" align="right" valign="bottom" class="mostbtext paddR">Service Mode </td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php echo $res2['customer_product_warrenty'];?></td>
        <td align="right" valign="bottom" class="mostbtext paddR"><?php if($res2['customer_product_warrenty'] == "Warranty"){echo "Accessories";}else{echo "Estemated Price";}?></td>
        <td align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><?php if($res2['customer_product_warrenty'] == "Warranty"){echo $res2['customer_product_acce'];}else{echo $res2['customer_product_estemated_price'];}?></td>
        </tr>
      <tr>
        <td height="10" colspan="4" align="right" valign="top"></td>
        </tr>
      <tr>
        <td height="35" align="right" valign="top" class="mostbtext paddR">Remark</td>
        <td colspan="3" align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><form id="form1" name="form1" method="post" action="">
          <textarea name="xx" cols="70" rows="5" id="xx" style="overflow:hidden; border:1px solid #FFFFFF"><?php echo $res2['customer_product_prob'];?></textarea>
                </form></td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" colspan="2" align="left" class="padd_L mostbtext"><!--<table width="60%" border="0" align="left" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center">&nbsp;&nbsp;Customer Signature </td>
          </tr>
        </table>--></td>
        <td align="right">&nbsp;</td>
        <td align="center" class="mostbtext">Delivered By </td>
        </tr>
      <tr>
        <td height="25" colspan="2" align="left" class="padd_L mostbtext">&nbsp;&nbsp;
          <!--<table width="60%" border="0" align="left" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">(Terms &amp; Cond. Accepted)</td>
            </tr>
          </table>--></td>
        <td align="right">&nbsp;</td>
        <td align="left" style="border-bottom:1px dotted #000000">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" colspan="3" align="left">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" colspan="3" align="left">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" colspan="3" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left"><span class="paddL mosttext"><b>VAT TIN : </b>19899556015 </span></td>
          </tr>
          <tr>
            <td align="left"><span class="paddL mosttext"><b>CST No.  : </b>19899556209 </span></td>
          </tr>
          <tr>
            <td align="left"><span class="paddL mosttext">Please pay by A/C payee chaque only. </span></td>
          </tr>
          <tr>
            <td align="left"><span class="paddL mosttext">No warranty claim will be entertained on physical / damaged / burnt / tampered material </span></td>
          </tr>
          <tr>
            <td align="left"><span class="paddL mosttext">Timing : 10:00 AM to 04:00 PM </span></td>
          </tr>
        </table></td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        </tr>
      

    </table></td>
  </tr>
</table>
</body>
</html>
