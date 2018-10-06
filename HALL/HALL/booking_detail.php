<?php 
include "includes/config.php";
include "connection/connection.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="js/all.js"></script>
<script>
function emp()
{
	if(document.getElementById("bid").value == "Enter Your Booking ID")
	{
		document.getElementById("bid").value = ""
	}else
	{
		if(document.getElementById("bid").value == "")
		{
			document.getElementById("bid").value = "Enter Your Booking ID"
		}
	}
}
</script>
<script type="text/javascript" src="js/calendarDateInput.js"></script>

<style>
.select{
font-size:18px;
border: 1px solid #ccc;
width: 200px;
border-radius:10px;
overflow: hidden;
padding:5px;
background-color:#264040;
color:#CCCCCC;
font-weight:bold;
font-family:Cursive;
cursor:pointer;
}
.select {font-size:16px;
border: 1px solid #ccc;
width: 200px;
border-radius:10px;
overflow: hidden;
padding:3px;
background-color:#264040;
color:#CCCCCC;
font-weight:bold;
font-family:Cursive;
cursor:pointer;
}
.btn{
border-radius:10px;
font-family:Cursive;
font-variant:small-caps;
}

</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title></head>

<body background="images/gradbackground.jpg">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
      <td><table width="100%" height="150" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><?php include "includes/picture.php";?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="15%" align="right"><table width="97%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="79%">&nbsp;</td>
          <td width="21%">&nbsp;</td>
        </tr>
        <tr>
          <td style="color:#CCCCCC; font-weight:bold">&nbsp;</td>
          <td align="right" style="text-decoration:none; color:#CCCCCC; font-weight:bold;"><a href="booking_detail.php" style="text-decoration:none; color:#CCCCCC; font-weight:bold;">TICKET</a> | <a href="login.php" style="text-decoration:none; color:#CCCCCC; font-weight:bold;">LOGIN</a></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    
    <tr>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" style="color:#CCCCCC; font-weight:bold"><form id="form1" name="form1" method="post" action="">
            Search by Booking ID :
                    <input name="bid" type="text" id="bid" value="Enter Your Booking ID" size="50" onfocus="emp()" onblur="emp()" />
                    <input type="submit" name="Submit" value="Search " />
          </form>
          </td>
        </tr>
        <tr>
          <td width="54%" align="center">&nbsp;</td>
        </tr>
		<?php
		if(isset($_POST['Submit']))
		{
			$bid = strtoupper($_POST['bid']);
			$sql = "select * from booking_master bm, multiplex_master mm, screen_master sm, movie_master mvm where bm.ack_id='$bid' and bm.mp_id=mm.mp_id and bm.sc_id=sm.sc_id and bm.mov_id=mvm.mov_id";
			$rec = mysql_query($sql);
		?>
        <tr>
          <td align="center"><table width="95%" border="0" cellspacing="1" cellpadding="1">
            <tr style="background-color:#FF6600">
              <td width="7%" align="center" style="font-weight:bold; color:#000000">Sl</td>
              <td width="43%" style="font-weight:bold; color:#000000">Booking Detail </td>
              <td width="36%" style="font-weight:bold; color:#000000">Movie Detail </td>
              <td width="14%" align="center" style="font-weight:bold; color:#000000">Options</td>
            </tr>
			<?php
			$res = mysql_fetch_assoc($rec);
			?>
            <tr style="background-color:#CCCCCC">
              <td align="center" valign="top">1</td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="right" style="font-weight:bold">Booking ID </td>
                  <td align="center" style="font-weight:bold">:</td>
                  <td align="left"><?php echo $res['ack_id'];?></td>
                </tr>
                <tr>
                  <td width="33%" align="right" style="font-weight:bold">Movie Name </td>
                  <td width="6%" align="center" style="font-weight:bold">:</td>
                  <td width="61%" align="left"><?php echo $res['mov_name']." ( ".$res['mov_lang']." )";?></td>
                </tr>
                <tr>
                  <td align="right" style="font-weight:bold">Multiplex Name </td>
                  <td align="center" style="font-weight:bold">:</td>
                  <td align="left"><?php echo $res['mp_name'];?></td>
                </tr>
                <tr>
                  <td align="right" style="font-weight:bold">Screen  </td>
                  <td align="center" style="font-weight:bold">:</td>
                  <td align="left"><?php echo $res['sc_name'];?></td>
                </tr>

              </table></td>
              <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="right" style="font-weight:bold">Movie Date  </td>
                  <td align="center" style="font-weight:bold">:</td>
                  <td align="left"><?php echo $res['movdate'];?></td>
                </tr>
                <tr>
                  <td width="33%" align="right" style="font-weight:bold">Movie Time </td>
                  <td width="6%" align="center" style="font-weight:bold">:</td>
                  <td width="61%" align="left"><?php echo $res['mov_time'];?></td>
                </tr>
                <tr>
                  <td align="right" valign="top" style="font-weight:bold">Seat Detail </td>
                  <td align="center" valign="top" style="font-weight:bold">:</td>
                  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <?php
				  $ssql = "select * from booking_detail where booking_id='$res[booking_id]'";
				  //echo $ssql;
				  $srec = mysql_query($ssql);
				  while($sres = mysql_fetch_assoc($srec))
				  {
				  ?>
                    <tr>
                      <td><?php echo $sres['cust_name']." ( ".$sres['seat_no']." )";?></td>
                    </tr>
				<?php
				}
				?>
                  </table></td>
                </tr>

              </table></td>
              <td align="center" valign="top"><a href="#" onclick="window.open('booking_ticket.php?ACK=<?php echo $res['ack_id'];?>','Print|Ticket','toolbar=no,resizable=no,location=0,width=800,hight=500')" style="color:#333333; text-decoration:none">Print Ticket</a> </td>
            </tr>
          </table></td>
        </tr>
		<?php
		}
		?>
        <tr>
          <td width="48%" align="center" valign="top">&nbsp;</td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><div id="sbooking" style="visibility:visible; text-align:left; vertical-align:top"></div></td>
    </tr>
    <tr>
      <td><?php include "includes/footer.php";?></td>
    </tr>
  </table>
</body>
</html>
