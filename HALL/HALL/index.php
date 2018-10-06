<?php 
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$multiplex = $_POST['mp'];
	$movie = $_POST['mov'];
	$seat = $_POST['seat'];
	$date = $_POST['movdate'];
	$time = $_POST['time'];
	$seat_cnt = $_POST['seat_cnt'];
	
	$bm_sql = "insert into booking_master(mp_id,sc_id,movdate,mov_time,booking_status,mov_id) values('$multiplex','$seat','$date','$time','1','$movie')";
	$bm_rec = mysql_query($bm_sql);
	$bm_pk = mysql_insert_id();
	for($i = 1; $i <= $seat_cnt; $i++)
	{
		$c_name = $_POST['p'.$i];
		$se_no = $_POST['se'.$i];
		
		$sd_sql = "insert into booking_detail(booking_id,cust_name,seat_no) values('$bm_pk','$c_name','$se_no')";
		$sd_rec = mysql_query($sd_sql);
		
	}
	
	if($bm_rec)
	{
		$booking_id = "ACK".date("Ymd").$bm_pk;
		$ack_sql = "update booking_master set ack_id='$booking_id' where booking_id='$bm_pk'";
		$ack_rec = mysql_query($ack_sql);
		//$ebi = 
		if($ack_rec)
		{
			echo "<script>
					alert('Booking Completed');
					location.replace('index.php?ACK=".base64_encode($booking_id)."');
					</script>";
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="js/all.js"></script>
<script>
function sel_seat(str)
{
	var sval = document.getElementById("s_"+str).value;
	var s_cnt = document.getElementById("seat_cnt").value;
	if(sval == "" || sval == 0)
	{
		document.getElementById("s_"+str).value = str;
		document.getElementById("t_"+str).innerHTML = "<img src='images/seat/booked.jpg' width='30' height='30' />";
		s_cnt = parseInt(s_cnt)+1;
		document.getElementById("seat_cnt").value = s_cnt;
	}else
	{
		document.getElementById("s_"+str).value = "";
		document.getElementById("t_"+str).innerHTML = "<img src='images/seat/empty.jpg' width='30' height='30' />";
		s_cnt = parseInt(s_cnt)-1;
		document.getElementById("seat_cnt").value = s_cnt;
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
<form id="form1" name="form1" method="post" action="" onsubmit="return chk_book()">
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
          <td style="color:#CCCCCC; font-weight:bold"><?php if(isset($_GET['ACK'])){echo "Your Booking ID is : ".base64_decode($_GET['ACK']);}?></td>
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
          <td colspan="3" align="center"><table width="40%" border="0" cellpadding="0" cellspacing="1">
            
            <tr>
              <td width="5%" align="center"><select name="movdate" id="movdate" class="select">
                <option value="0">Select Date</option>
                <?php
					$sql = "select * from movie_master where mov_status='1'";
					$rec = mysql_query($sql);
					while($res = mysql_fetch_assoc($rec))
					{
				?>
                <option value="<?php echo $res['mov_date'];?>"><?php echo $res['mov_date'];?></option>
                <?php
					}
				?>
              </select></td>
              <td align="center"><select name="time" id="time" class="select">
                <option value="0">Select Time</option>
                <?php
					$sql = "select * from movie_master where mov_status='1'";
					$rec = mysql_query($sql);
					while($res = mysql_fetch_assoc($rec))
					{
				?>
                  <option value="<?php echo $res['mov_time'];?>"><?php echo $res['mov_time'];?></option>
                  <?php
					}
				?>
              </select>              </td>
              <td width="15%" align="center"><select name="seat" id="seat" class="select">
                <option value="0">Select Seats</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
              </select></td>
              <td width="15%" align="center"><select name="mov" id="mov" class="select">
                  <option value="0">Select Movie</option>
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
              <td width="15%" align="center"><select name="mp" id="mp" onchange="getseat()" class="select">
                  <option value="0">Select Multiplex</option>
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
              </select></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td colspan="3" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td width="48%" colspan="3" align="center" valign="top"><div id="areaHint" style="visibility:visible; text-align:left; vertical-align:top"><?php include "get_seat.php";?></div></td>
          </tr>
        
        <tr>
          <td colspan="3" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="right">&nbsp;</td>
          </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td width="5%" align="center">&nbsp;</td>
          <td width="49%" align="left"><input type="button" class="btn" value="Book Seats" width="80" height="30"  onclick="show_booking()"/></td>
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
</form>
</body>
</html>
