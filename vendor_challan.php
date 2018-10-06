<?php ob_start();
session_start();
include "chk_login.php";
include "includes/config.php";
include "includes/commonfunction.php";
include "includes/functions.php";
include_once("connection/adsmedia.php");

$CP = $_GET['CP'];
/*$sql2 = "select * from to_vendor v,customer_product cp,product_trans pt where v.to_vendor_id='$_GET[CP]' and v.customer_product_id=cp.customer_product_id and v.product_trans_id=pt.product_trans_id";
$rec2 = mysql_query($sql2);
$res2 = mysql_fetch_assoc($rec2);*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
<link href="style/stylesheet.css" rel="stylesheet" type="text/css">
<link href="style/style.css" rel="stylesheet" type="text/css">
<script>
function xyz()
{
	document.getElementByID('xx').select();
}
</script>
</head>

<body onload="xyz">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FBFAFA" style="border:1px solid #000000" onclick="window.print()" title="Click To Print">
  <tr>
    <td width="43%" height="104" align="center" style="border-bottom:1px solid #000000" class="mosttext"><p><img src="images/Vohra_brothers_vector.jpg" width="329" height="71" /></p>
    <p>Guruaastha Building, Behind Axis Bank, Punjabipara, Sevoke Road, Siliguri - 01 </p></td>
    <td width="57%" align="right" valign="bottom" style="border-bottom:1px solid #000000; padding-right:10px;" class="mostbtext">Phone : 0353-2642547<br />
    Email : vohrabros@gmail.com<br /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	
      <tr>
        <td height="35" colspan="4" align="left" class="mostbbtext paddL" style="border-bottom:1px solid #000000"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><span class="mostbbtext paddL"> Challan Number  : <span class="mosttext"><?php echo $CP;?></span></span></td>
            <td align="right"><span class="note"><b>Date : <?php echo $_GET['DT'];?></b></span></td>
          </tr>
        </table></td>
        <td align="right" class="paddR note" style="border-bottom:1px solid #000000">&nbsp;</td>
      </tr>
      <tr>
        <td width="20%" height="25" align="right">&nbsp;</td>
        <td width="30%" align="left" class="pad_l note">&nbsp;</td>
        <td width="16%" align="right">&nbsp;</td>
        <td width="33%" align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" colspan="4" align="center" class="mostbigtext uline">VENDOR CHALLAN </td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="25" colspan="4" align="right"><table width="85%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" align="left" class="mostbigstext">M/S.<span class="paddR"> 
              <?php $all_i = vendor_detail($_GET['VI']); list($a,$b,$c,$d) = explode("#",$all_i);echo $a;?></span>         </td>
          </tr>
          <tr>
            <td height="25" align="left" class="mostbigstext"><?php echo $d?></td>
          </tr>
          <tr>
            <td height="25" align="left" class="mostbigstext"><?php echo $b?></td>
          </tr>

        </table></td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" colspan="4" align="right" style="border-bottom:2px solid #000000;">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note" style="border-bottom:2px solid #000000;">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
	  <?php
	  $prod_name = get_prod($CP);
	  $prarr = explode("@@",$prod_name);
	  ?>
     
      <tr>
        <td width="20%" align="right" valign="top" class="mostbtext paddR">Product Detail   </td>
        <td colspan="3" align="left" valign="top" class="paddL mosttext"><table width="50%" border="0" cellspacing="0" cellpadding="0">
          <?php
			  for($pr = 0; $pr < count($prarr); $pr++)
			  {
			  ?>
		  <tr>
            <td height="30" style="border-bottom:1px dotted #000000"><?php echo $prarr[$pr];?></td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
		  <?php
		  }
		  ?>
        </table></td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      
      <tr>
        <td height="10" colspan="4" align="right" valign="top"></td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="35" align="right" valign="top" class="mostbtext paddR">Problem In Brief</td>
        <td colspan="3" align="left" valign="bottom" class="paddL mosttext" style="border-bottom:1px dotted #000000"><form id="form1" name="form1" method="post" action="">
          <textarea name="xx" cols="70" rows="5" id="xx" style="overflow:hidden; border:1px solid #FFFFFF"><?php echo $_GET['RM'];?></textarea>
                </form>        </td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" colspan="2" align="left" class="paddL mostbtext">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="center" class="mostbtext">Authorised Signatory </td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" style="border-bottom:1px dotted #000000">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" colspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
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
            <td align="left"><span class="paddL mosttext">No warranty claim will be entertained on physical / damaged / burnt / tampered &nbsp;&nbsp;&nbsp;&nbsp;material </span></td>
          </tr>
          <tr>
            <td align="left"><span class="paddL mosttext">Timing : 10:00 AM to 04:00 PM </span></td>
          </tr>
        </table></td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      <tr>
        <td height="25" align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td align="right">&nbsp;</td>
        <td align="left" class="pad_l note">&nbsp;</td>
        <td width="1%" align="left" class="pad_l note">&nbsp;</td>
      </tr>
      

    </table></td>
  </tr>
</table>
</body>
</html>
