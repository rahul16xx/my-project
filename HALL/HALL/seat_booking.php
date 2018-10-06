<?php 
session_start();
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$multiplex = $_POST['mp'];
	$cnt = $_POST['cnt'];
	$date = $_POST['movdate'];
	$time = $_POST['time'];
	$movie = $_POST['mov'];

	$isql = "insert into booking_master(mp_id,sc_id,mov_time,movdate,booking_status,movie_id) values('$multiplex','$time','$movdate','1','$movie')";
	$irec = mysql_query($isql);

	echo "<script>
			alert('Data Inserted');
			location.replace('seat_booking.php?')
		</script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="js/all.js"></script>
<script type="text/javascript" src="js/calendarDateInput.js"></script>


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
      <td><table width="100%" height="150" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td width="14%">&nbsp;</td>
    </tr>
    
    <tr>
      <td align="center"><table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="3" align="center"><table width="80%" border="0" align="center" cellpadding="0" cellspacing="1">
            <tr>
              <td colspan="6">&nbsp;</td>
              <td align="center">[LOGIN]</td>
            </tr>
            <tr>
              <td width="7%" align="right">Date</td>
              <td width="17%" align="left"><script>DateInput('movdate', true, 'YYYY-MM-DD')</script></td>
              <td width="17%" align="center">Time
                <input name="time" type="time" id="time" /></td>
              <td width="16%" align="center"><select name="select3">
                  <option value="0">... Select Seats ...</option>
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
              <td width="16%" align="center"><select name="mov" id="mov">
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
              <td width="18%" align="center"><select name="mp" id="mp" onchange="getseat()">
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
              </select></td>
              <td width="9%"><img src="images/Book-Now-Button-PNG-Photos.png" width="80" height="30" /></td>
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
          <td align="right">&nbsp;</td>
          <td width="5%" align="center">&nbsp;</td>
          <td width="49%" align="left"><input type="submit" name="Submit" value="Book" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td><?php include "includes/footer.php";?></td>
    </tr>
  </table>
</form>
</body>
</html>
