<?php 
session_start();
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$multiplex = $_POST['mp'];
	$movie = $_POST['mov'];
	$cnt = $_POST['cnt'];
	$screen = $_POST['sc_name'];
	
	$isql = "insert into movie_detail(mp_id,mov_id,sc_id) values('$multiplex','$movie','$screen')";
	$irec = mysql_query($isql);
	if($irec)
	{
		echo "<script>
				alert('Data Inserted!!');
				location.replace('booking.php?')
			</script>";
	}
}
if(isset($_GET['E']))
{
	$E = $_GET['E'];
	$esql = "select * from movie_detail where mov_id='$E'";
	$erec = mysql_query($esql);
	$eres = mysql_fetch_assoc($erec);
}else if(isset($_GET['D']))
{
	$D = $_GET['D'];
	$dsql = "delete from movie_detail where md_id='$D'";
	$drec = mysql_query($dsql);
	if($drec)
		{
			echo "<script>
				alert('Deleted Successfully')
				location.replace('booking.php?')
				</script>";
		}	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="js/calendarDateInput.js"></script>
<script type="text/javascript" src="js/all.js"></script>
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
<title><?php echo $title;?></title></head>

<body background="images/gradbackground.jpg">
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
    
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
          <td colspan="3" align="center" style="font-size:12px; color:#CCCCCC; font-weight:bold;" >BOOKING ENTRY</td>
          </tr>
        <tr>
          <td colspan="3" align="right">&nbsp;</td>
          </tr>
        <tr style="color:#CCCCCC">
          <td align="right" style="font-family:Cursive;">MOVIE DATE </td>
          <td align="center">:</td>
          <td align="left"><script>DateInput('movdate', true, 'YYYY-MM-DD')</script></td>
        </tr>
        <tr style="color:#CCCCCC">
          <td align="right" style="font-family:Cursive;">MOVIE NAME </td>
          <td align="center">:</td>
          <td align="left"><select name="mov" id="mov" class="box">
            <option value="0">... Select Movie ...</option>
             <?php
					$sql = "select * from movie_master where mov_status='1'";
					$rec = mysql_query($sql);
					while($res = mysql_fetch_assoc($rec))
					{
				?>
                  <option value="<?php echo $res['mov_id'];?>"><?php echo $res['mov_name'];?></option>
                  <?php
					}
				?>
                    </select></td>
        </tr>
        <tr style="color:#CCCCCC">
          <td width="46%" align="right" style="font-family:Cursive;">MULTIPLEX</td>
          <td width="5%" align="center">:</td>
          <td width="49%" align="left"><select name="mp" id="mp" class="box">
            <option value="0">... Select Multiplex ...</option>
		  <?php
					$msql = "select * from multiplex_master where mp_status='1'";
					$mrec = mysql_query($msql);
					while($mres = mysql_fetch_assoc($mrec))
					{
				?>
                  <option value="<?php echo $mres['mp_id'];?>"><?php echo $mres['mp_name'];?>,<?php echo $mres['mp_address'];?></option>
                  <?php
					}
				?>
          </select>          </td>
        </tr>
        <tr style="color:#CCCCCC">
          <td align="right" style="font-family:Cursive;">SCREEN</td>
          <td align="center">:</td>
          <td align="left"><select name="sc_name" id="sc_name" class="box">
            <option value="0">... Select Screen ...</option>
			<?php
					$ssql = "select * from screen_master where sc_status='1'";
					$srec = mysql_query($ssql);
					while($sres = mysql_fetch_assoc($srec))
					{
				?>
                  <option value="<?php echo $sres['sc_id'];?>"><?php echo $sres['sc_name'];?></option>
                  <?php
					}
				?>
          </select>          </td>
        </tr>
        <tr >
          <td colspan="3" align="right">&nbsp;</td>
          </tr>
        
        <tr>
          <td align="right">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="left"><input type="submit" class="btn" name="Submit" value="Submit"  id="Submit"/>
            <input name="Reset" type="reset" class="btn" id="Reset" value="Reset" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
	<?php
	 
	 
	  $fsql = "select * from movie_master mo where mo.mov_status='1'";
	  $frec = mysql_query($fsql);
	  $fnum = mysql_num_rows($frec);
	  
	  if($fnum > 0)
	  
	?>
    <tr>
      <td width="48%" align="center" valign="top"><div id="areaHint" style="visibility:visible; text-align:left; vertical-align:top">
        <table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
          <tr style="color:#CCCCCC">
            <td width="5%" align="center">SL NO. </td>
            <td width="10%" >MOVIE NAME</td>
            <td width="10%" >DATE</td>
            <td width="10%" >MULTIPLEX </td>
            <td width="10%" >SCREEN</td>
            <td width="10%" align="center" >OPTION</td>
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
          <tr style="background-color:<?php echo $row_color ?>; color:#CCCCCC; font-weight:bolder;">
            <td height="25" align="center"><?php echo $i;?></td>
            <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="center"><?php echo $fres['mov_name'];?></td>
            </tr>
            </table></td>
            <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><?php echo $fres['mov_date'];?></td>
              </tr>
            </table></td>
            <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
             <?php
		  	$md_sql = "select * from movie_detail md, multiplex_master mp where md.mov_id='$fres[mov_id]' and md.mp_id=mp.mp_id";
			$md_rec = mysql_query($md_sql);
			while($md_res = mysql_fetch_assoc($md_rec))
			{
		  ?>
            <tr>
              <td align="center"><?php echo $md_res['mp_name'];?></td>
            </tr>
		<?php 
		}
		?>
            </table></td>
            <td><table width="99%" border="0" cellspacing="0" cellpadding="0">
               <?php
		  	$md_sql = "select * from movie_detail md, screen_master sc where md.mov_id='$fres[mov_id]' and md.sc_id=sc.sc_id";
			$md_rec = mysql_query($md_sql);
			while($md_res = mysql_fetch_assoc($md_rec))
			{
		  ?>
            <tr>
              <td align="center"><?php echo $md_res['sc_name'];?></td>
            </tr>
		<?php 
		}
		?>
            </table></td>
            <td align="center" valign="middle"><a href="booking.php?E=<?php echo $fres['md_id'];?>" style="text-decoration:none; color:#CCCCCC;">EDIT</a>|<a onclick="return confirm('Are You Sure?')" href="booking.php?D=<?php echo $fres['md_id'];?>" style="text-decoration:none; color:#CCCCCC;">DELETE</a></td>
          </tr>
          <?php
		  	$row_count ++;
			$i++;
		  }
		  ?>
        </table>
      </div></td>
    </tr>
    <tr>
      <td><?php include "includes/footer.php";?></td>
    </tr>
  </table>
</form>
</body>
</html>
