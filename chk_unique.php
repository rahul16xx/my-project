<?php
include "includes/config.php";
include_once("connection/adsmedia.php");
function sent_to_vendor($x)
{
	$sql = "select * from to_vendor where product_trans_id='$x'";
	$rec = mysql_query($sql);
	$num = mysql_num_rows($rec);
	return $num;
}
$R = $_GET['R'];
$R_arr = explode("**",$R);
$P = "";
for($fR = 0; $fR < count($R_arr); $fR++)
{
	$RX = $R_arr[$fR];
	#echo "select * from customer_product where customer_product_receipt_no='$RX'"."<HR>";
	$sql2 = mysql_query("select * from customer_product where customer_product_receipt_no='$RX'");
	$res2 = mysql_fetch_assoc($sql2);
	$x = $res2['customer_product_id'];
	$sql = mysql_query("select * from product_trans where product_master_id='$x'");
	$num = mysql_num_rows($sql);
	if($num > 0)
    {
		while($res = mysql_fetch_assoc($sql))
		{
			$stv = sent_to_vendor($res['product_trans_id']);
		    if($stv == 0)
		    {
				if($P == "")
				{
					$P = $RX."%%".$res['product_trans_id']."@@".$res['product_name'];
				}else
				{
					$P = $P."**".$RX."%%".$res['product_trans_id']."@@".$res['product_name'];
				}
			}
		}
	}
}
?>
<select name="prod[]" size="10" multiple="multiple" id="prod[]">
  <option value="0">... Select Product ...</option>
  <?php
  
  	$P_arr = explode("**",$P);
	for($fP = 0; $fP < count($P_arr); $fP++)
	{
		$PX = $P_arr[$fP];
		list($pti,$pn) = explode("@@",$PX);
  ?>
  <option value="<?php echo $pti;?>"><?php echo $pn;?></option>
  <?php	
  	}
  ?>
</select>&nbsp;*