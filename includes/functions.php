<?php
function group_name($cid)
{
	$sql = mysql_query("select group_master_name from group_master where group_master_id='$cid'");
	$res = mysql_fetch_assoc($sql);
	
	$cat = $res['group_master_name'];
	return $cat;
}
function traller_name($cid)
{
	$sql = mysql_query("select full_name from login_master where login_id='$cid'");
	$res = mysql_fetch_assoc($sql);
	
	$cat = $res['full_name'];
	return $cat;
}
function get_prod($vch)
{
	$xx = "";
	$ptsql = mysql_query("select * from to_vendor where to_vendor_challantovendor='$vch'");
	while($ptres = mysql_fetch_assoc($ptsql))
	{
				$pt_sql = "select * from product_trans where product_trans_id='$ptres[product_trans_id]'";
				$pt_rec = mysql_query($pt_sql);
				$pt_res = mysql_fetch_assoc($pt_rec);
				if($xx == "")
				{
					$xx = $pt_res['product_name']." ( ".$pt_res['product_sl_no']." )";
				}else
				{
					$xx = $xx."@@".$pt_res['product_name']." ( ".$pt_res['product_sl_no']." )";
				}
	}
	return $xx;
}
function trans_id($cid)
{
	$sql = mysql_query("select cash_master_cashier_id from cash_master_cashier_trans where cash_master_id='$cid'");
	$res = mysql_fetch_assoc($sql);
	
	$cat = $res['cash_master_cashier_id'];
	return $cat;
}
function zone_name($cid)
{
	$sql = mysql_query("select zone_master_name from zone_master where zone_master_id='$cid'");
	$res = mysql_fetch_assoc($sql);
	
	$cat = $res['zone_master_name'];
	return $cat;
}
function childornot($id)
{
	$sql = mysql_query("select * from menu_master where parent_menu='$id'");
	$num = mysql_num_rows($sql);
	return $num;
}
function parent_menu($id)
{
	$sql = mysql_query("select * from menu_master where menu_id='$id'");
	$res = mysql_fetch_assoc($sql);
	$num = mysql_num_rows($sql);
	$pid = $res['parent_menu'];
	return $pid;
}
function parent_name($id)
{
	if($id == 0)
	{
		$pid = "Parent Menu";
	}else
	{
		$sql = mysql_query("select menu_name from menu_master  where menu_id='$id'");
		$res = mysql_fetch_assoc($sql);
		$num = mysql_num_rows($sql);
		$pid = $res['menu_name'];
	}
	return $pid;
}
function usrname($x)
{
	$msql="select * from login_master where login_id='$x'";
	#echo $msql;
	$msql_rec=mysql_query($msql);
	$msql_res= mysql_fetch_assoc($msql_rec);
	$nm= $msql_res['full_name'];
	return ucwords($nm);
}
function last_cust()
{
	$sql = mysql_query("select max(saving_acc_master_id) as X from saving_acc_master");
	$res = mysql_fetch_assoc($sql);
	$X = $res['X'];
	$X++;
	return $X;
}	
function login_id($aid)
{
	$sql = mysql_query("select login_id from saving_acc_master where saving_acc_master_id='$aid'");
	$res = mysql_fetch_assoc($sql);
	$lid = $res['login_id'];
	return $lid;
}
function challan_to_id($ch)
{
	$sql = mysql_query("select * from customer_product where customer_product_receipt_no='$ch'");
	$res = mysql_fetch_assoc($sql);
	$id = $res['customer_product_id'];
	return $id;
}
function vendor_detail($vid)
{
	$sql = mysql_query("select * from vendor_master where vendor_id='$vid'");
	$res = mysql_fetch_assoc($sql);
	$id = $res['vendor_name']."#".$res['vendor_contact']."#".$res['vendor_email']."#".$res['vendor_add'];
	return $id;
}
function vendor_receive($vid)
{
	$sql = mysql_query("select * from to_vendor where customer_product_id='$vid'");
	$num = mysql_num_rows($sql);
	$X = 0;
	while($res = mysql_fetch_assoc($sql))
	{
		$id = $res['to_vendor_received_date'];
		if($id == "0000-00-00" || $id == "")
		{
			
		}else
		{
			$X++;
		}
	}
	if($X != $num)
	{
		return 1;
	}else
	{
		return 2;
	}
}
function vendor_status($vid)
{
	$sql = mysql_query("select * from to_vendor where product_trans_id='$vid'");
	$num = mysql_num_rows($sql);
	$res = mysql_fetch_assoc($sql);
	$id = $res['to_vendor_received_date'];
	if($num == 0)
	{
		return 1;
	}
	elseif($id == "0000-00-00" || $id == "")
	{
		return 2;
	}else
	{
		return 3;
	}
}
function vendor_entry($x)
{
	$sql = "select * from to_vendor where customer_product_id='$x'";
	$rec = mysql_query($sql);
	$num = mysql_num_rows($rec);
	return $num;
}
function prod_cnt($x)
{
	$sql = "select * from product_trans where product_master_id='$x'";
	$rec = mysql_query($sql);
	$num = mysql_num_rows($rec);
	return $num;
}
function rec_dt($x)
{
	$sql = "select * from to_vendor where product_trans_id='$x'";
	$rec = mysql_query($sql);
	$res = mysql_fetch_assoc($rec);
	$dt = $res['to_vendor_received_date'];
	$nsl = $res['to_vendor_new_slno'];
	return $dt."##".$nsl;
}
?>