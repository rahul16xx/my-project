<?php
session_start();
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$mulname=$_POST['mulname'];
	$contact=$_POST['contact'];
	$mstat=$_POST['status'];		
	$add=$_POST['add'];
	if($_POST['Submit'] == "Submit")
	{
		mysql_select_db(hall);
		$msql = "insert into multiplex_master (mp_name,mp_address,mp_contact,mp_status) values('$mulname','$add','$contact','$mstat')";
		$mrec = mysql_query($msql);
		if($mrec)
		{
			echo "<script>
				alert('Multiplex Successfully Added')
				location.replace('multiplexreg.php?')
				</script>";
		}
	}elseif($_POST['Submit'] == "Update")
	{
		$pk = $_POST['pk'];
		$usql = "update multiplex_master set mp_name='$mulname',mp_contact='$contact',mp_status='$mstat',mp_address='$add' where mp_id='$pk'";
		$urec = mysql_query($usql);
		if($urec)
		{
			echo "<script>
				alert('Details Updated')
				location.replace('multiplexreg.php?')
				</script>";
		}
	}
}
if(isset($_GET['E']))
{
	$E = $_GET['E'];
	$esql = "select * from multiplex_master where mp_id='$E'";
	$erec = mysql_query($esql);
	$eres = mysql_fetch_assoc($erec);
}
else if(isset($_GET['D']))
{
	$D = $_GET['D'];
	$dsql = "delete from multiplex_master where mp_id='$D'";
	$drec = mysql_query($dsql);
	if($drec)
		{
			echo "<script>
				alert('Deleted Successfully')
				location.replace('multiplexreg.php?')
				</script>";
		}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
</head>
<style>
.box{
border-radius:5px;
color:#333333;
overflow:hidden;
}
.btn{
border-radius:10px;
font-family:Cursive;
font-variant:small-caps;
}
</style>
<body background="images/gradbackground.jpg">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include "includes/banner.php";?></td>
  </tr>
  

  <tr>
    <td><?php include "includes/header.php";?></td>
  </tr>
  <tr>
      <td>&nbsp;</td>
    </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td colspan="3" style="font-size:12px; color:#CCCCCC; font-weight:bold;" align="center">MULTIPLEX ENTRY</td>
                  </tr>
                <tr>
                  <td colspan="3" align="right">&nbsp;</td>
                  </tr>
                <tr style="color:#CCCCCC">
                  <td width="41%" align="right" style="font-family:Cursive;">NAME </td>
                  <td width="4%" align="center">:</td>
                  <td width="55%" align="left"><input name="mulname" class="box" type="text" id="mulname" value="<?php echo @$eres['mp_name'];?>" /></td>
                </tr>
                <tr style="color:#CCCCCC">
                  <td align="right" style="font-family:Cursive;">CONTACT  </td>
                  <td align="center" valign="top">:</td>
                  <td align="left"><input name="contact" type="text" class="box" id="contact" maxlength="10" value="<?php echo @$eres['mp_contact'];?>"/></td>
                </tr>
                <tr style="color:#CCCCCC">
                  <td align="right" style="font-family:Cursive;">STATUS  </td>
                  <td align="center">:</td>
                  <td align="left"><input type="radio" name="status" value="1" <?php if ($eres['mp_status'] == "1"){echo "checked";} ?>/>
                      ACTIVE
                      <input type="radio" name="status" value="0" <?php if ($eres['mp_status'] == "0"){echo "checked";} ?>/>
                      IN-ACTIVE</td>
                </tr>
                <tr style="color:#CCCCCC">
                  <td align="right" valign="top" style="font-family:Cursive;">ADDRESS</td>
                  <td align="center" valign="top">:</td>
                  <td align="left"><textarea name="add" cols="50" rows="5" id="add" class="box" ><?php echo @$eres['mp_address'];?></textarea></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="left"><input type="submit" class="btn" name="Submit" <?php if(isset($_GET['E'])){echo "value='Update'";}else{?>value="Submit"<?php }?> />
                      <input name="Reset" type="reset" id="Reset" class="btn" value="Reset" />
                      <input name="pk" type="hidden" id="pk" value="<?php echo $_GET['E'];?>" /></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <?php 
	  $fsql = "select * from multiplex_master";
	  $frec = mysql_query($fsql);
	  $fnum = mysql_num_rows($frec);
	  
	  if($fnum > 0)
	  {
	  ?>
                <tr>
                  <td height="30" colspan="3" align="center"><table width="95%" border="0" cellspacing="1" cellpadding="1">
                      <tr style="color:#CCCCCC">
                        <td width="5%" height="25" align="center">SL NO. </td>
                        <td width="20%">NAME</td>
                        <td width="20%">ADDRESS</td>
                        <td width="15%">CONTACT </td>
                        <td width="20%" align="center">STATUS</td>
                        <td width="10%" align="center">OPTION</td>
                      </tr>
                      <?php
		  
		  	$color1 = "#264040";
			$color2 = "#427070";
			$row_count = 0;
		  
		  $i = 1;
		  while($fres = mysql_fetch_assoc($frec))
		  {
		  
		  	$row_color = ($row_count % 2) ? $color1 : $color2;
		  
		  ?>
                      <tr style="background-color:<?php echo $row_color ?>; color:#CCCCCC; font-weight:bold;">
                        <td height="25" align="center"><?php echo $i;?></td>
                        <td><?php echo $fres['mp_name'];?></td>
                        <td><?php echo $fres['mp_address'];?></td>
                        <td><?php echo $fres['mp_contact'];?></td>
                        <td align="center"><?php if($fres['mp_status'] == 1){echo "Active";}else{echo "Inactive";}?></td>
                        <td align="center"><a href="multiplexreg.php?E=<?php echo $fres['mp_id'];?>" style="text-decoration:none; color:#CCCCCC;">EDIT</a>| <a onclick="return confirm('Are You Sure?')" href="multiplexreg.php?D=<?php echo $fres['mp_id'];?> " style="text-decoration:none; color:#CCCCCC;">DELETE</a></td>
                      </tr>
                      <?php
		  	$row_count ++;
			$i++;
		  }
		  ?>
                  </table></td>
                </tr>
                <?php
	  }
	  ?>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>
