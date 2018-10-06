<?php 
session_start();
include "includes/config.php";
include "connection/connection.php";

if($_POST['Submit'] == "Submit")
{
	$multiplex = $_POST['mp'];
	$location = $_POST['loc'];
	$cnt = $_POST['cnt'];
	$screen = $_POST['sc_name'];
	$seat = $_POST['no_of_seat'];
	$status = $_POST['status'];
	
	$isql = "insert into screen_master(mp_id,sc_name,sc_status,no_of_seat) values('$multiplex','$screen','$status','$seat')";
	$irec = mysql_query($isql);
	if($irec)
	{
		echo "<script>
				alert('Data Inserted');
				location.replace('screenreg.php?')
			</script>";
	}elseif($_POST['Submit'] == "Update")
	{
		$pk = $_POST['pk'];
		$usql = "update screen_master set mp_id='$multiplex',sc_name='$screen',sc_status='$screen',no_of_seat='$seat' where sc_id='$pk'";
		$urec = mysql_query($usql);
		if($urec)
		{
			echo "<script>
				alert('Details Updated')
				location.replace('screenreg.php?')
				</script>";
		}
	}
}
if(isset($_GET['E']))
{
	$E = $_GET['E'];
	$esql = "select * from screen_master where sc_id='$E'";
	$erec = mysql_query($esql);
	$eres = mysql_fetch_assoc($erec);
}
else if(isset($_GET['D']))
{
	$D = $_GET['D'];
	$dsql = "delete from screen_master where sc_id='$D'";
	$drec = mysql_query($dsql);
	if($drec)
		{
			echo "<script>
				alert('Deleted Successfully')
				location.replace('screenreg.php?')
				</script>";
		}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
</head>

<body background="images/gradbackground.jpg">
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
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
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td colspan="3" style=" font-size:12px; color:#CCCCCC; font-weight:bold;" align="center">SCREEN ENTRY</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr style="color:#CCCCCC">
              <td width="46%" align="right" style="font-family:Cursive;">MULTIPLEX</td>
              <td width="5%" align="center">:</td>
              <td width="49%" align="left"><select name="mp" id="mp" class="box">
                  <option value="0">... Select Multiplex ...</option>
                  <?php
					$sql = "select * from multiplex_master where mp_status='1'";
					$rec = mysql_query($sql);
					while($res = mysql_fetch_assoc($rec))
					{
				?>
                  <option value="<?php echo $res['mp_id'];?>"><?php echo $res['mp_name'];?></option>
                  <?php
					}
				?>
                </select>              </td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">SCREEN NAME </td>
              <td align="center">:</td>
              <td align="left">
                  <input type="radio" name="sc_name" value="1" <?php if ($eres['sc_name'] == "1"){echo "checked";} ?> />
                  1
                  <input type="radio" name="sc_name" value="2" <?php if ($eres['sc_name'] == "2"){echo "checked";} ?>/>
                  2
                  <input type="radio" name="sc_name" value="3" <?php if ($eres['sc_name'] == "3"){echo "checked";} ?>/>
                  3
                  <input type="radio" name="sc_name" value="4" <?php if ($eres['sc_name'] == "4"){echo "checked";} ?>/>
                  4</td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">NO.OF.SEAT</td>
              <td align="center">:</td>
              <td align="left">
                  <input type="radio" name="no_of_seat" value="94" <?php if ($eres['no_of_seat'] == "94"){echo "checked";} ?>/>
                  94
                  <input type="radio" name="no_of_seat" value="109" <?php if ($eres['no_of_seat'] == "109"){echo "checked";} ?>/>
                  109
                  <input type="radio" name="no_of_seat" value="124" <?php if ($eres['no_of_seat'] == "124"){echo "checked";} ?>/>
                  124
                  <input type="radio" name="no_of_seat" value="139" <?php if ($eres['no_of_seat'] == "139"){echo "checked";} ?>/>
                  139</td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">STATUS</td>
              <td align="center">:</td>
              <td align="left"><input type="radio" name="status" value="1" <?php if ($eres['sc_status'] == "1"){echo "checked";} ?>/>
                ACTIVE
                <input type="radio" name="status" value="0" <?php if ($eres['sc_status'] == "0"){echo "checked";} ?>/>
                IN-ACTIVE</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" class="btn" name="Submit" value="Submit" />
                  <input name="Reset" type="reset" class="btn" id="Reset" value="Reset" />
                  <input name="pk" type="hidden" id="pk" value="<?php echo $_GET['E'];?>" /></td>
            </tr>
          </table></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php
	  $i = 1;
	  $msql = "select * from screen_master sm, multiplex_master mm where sm.mp_id=mm.mp_id and sm.sc_status='1' group by sm.mp_id";
	  $mrec = mysql_query($msql);
	  $mnum = mysql_num_rows($mrec);
	  
	  if($mnum > 0)
	  {
	 ?>
    <tr>
      <td align="center"><table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr style="color:#CCCCCC">
		<td width="5%" align="center">SL NO </td>
          <td width="30%" align="center">MULTIPLEX</td>
          <td width="15%" align="center">SCREEN NO </td>
          <td width="15%" align="center">NO OF SEAT </td>
          <td width="15%" align="center">STATUS</td>
          <td width="15%" align="center">OPTION</td>
        </tr>
		<?php
		  
		  	$color1 = "#264040";
			$color2 = "#427070";
			$row_count = 0;
		  
		  $i = 1;
		  while($mres = mysql_fetch_assoc($mrec))
		  {
		  	$row_color = ($row_count % 2) ? $color1 : $color2;
		?>
        <tr style="background-color:<?php echo $row_color ?>; color:#CCCCCC; font-weight:bold;">
		<td align="center"><?php echo $i;?></td>
          <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><?php echo $mres['mp_name'];?>,<?php echo $mres['mp_address'];?></td>
            </tr>
            
          </table></td>
          <td align="center" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
		  <?php
		  	$sc_sql = "select * from screen_master where mp_id='$mres[mp_id]'";
			$sc_rec = mysql_query($sc_sql);
			while($sc_res = mysql_fetch_assoc($sc_rec))
			{
		  ?>
            <tr>
              <td align="center"><?php echo $sc_res['sc_name'];?></td>
            </tr>
		<?php 
		}
		?>
          </table></td>
          <td align="center" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            
          <?php
		  	$sc_sql = "select * from screen_master where mp_id='$mres[mp_id]'";
			$sc_rec = mysql_query($sc_sql);
			while($sc_res = mysql_fetch_assoc($sc_rec))
			{
		  ?>
            <tr>
              <td align="center"><?php echo $sc_res['no_of_seat'];?></td>
            </tr>
		<?php 
		}
		?>
           
          </table></td>
          <td align="center" valign="top"><table width="99%" border="0" cellspacing="0" cellpadding="0">
           
            <?php
		  	$sc_sql = "select * from screen_master where mp_id='$mres[mp_id]'";
			$sc_rec = mysql_query($sc_sql);
			while($sc_res = mysql_fetch_assoc($sc_rec))
			{
		  ?>
            <tr>
              <td align="center"><?php if($sc_res['sc_status'] == 1){echo "Active";}else{echo "Inactive";}?></td>
            </tr>
		<?php 
		}
		?>
            
          </table></td>
          <td align="center" valign="top"><a href="screenreg.php?E=<?php echo $mres['sc_id'];?>" style="text-decoration:none; color:#CCCCCC;">EDIT</a>| <a onclick="return confirm('Are You Sure?')" href="screenreg.php?D=<?php echo $mres['sc_id'];?> " style="text-decoration:none; color:#CCCCCC;">DELETE</a></td>
        </tr>
        <?php
			$row_count ++;
			$i++;
		  }
		  ?>
      </table></td>
	  <?php
	  }
	  ?>
    </tr>
    <tr>
      <td><?php include "includes/footer.php";?></td>
    </tr>
  </table>
</form>
</body>
</html>
