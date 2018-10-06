<?php
include "includes/config.php";
include "connection/connection.php";

$D = $_GET['D'];
$M = $_GET['M'];
$T = $_GET['T'];
$S = $_GET['S'];
$mms_sql = "select * from movie_detail md, screen_master sm where md.mov_id='$M' and md.mp_id='$T' and md.sc_id=sm.sc_id";
$mms_rec = mysql_query($mms_sql);
$mms_res = mysql_fetch_assoc($mms_rec);
$no_of_seat = $mms_res['no_of_seat'];
$first_row = $no_of_seat - 34;

?>
<script>
function sel_seat(str)
{
	var sval = document.getElementById("s_"+str).value;
	var s_cnt = document.getElementById("seat_cnt").value;
	var se = document.getElementById("seat").value;
	
	if(sval == "" || sval == 0)
	{
		s_cnt = parseInt(s_cnt)+1;
		if(se >= s_cnt)
		{
			document.getElementById("s_"+str).value = str;
			document.getElementById("t_"+str).innerHTML = "<img src='images/seat/booked.jpg' width='30' height='30' />";
			document.getElementById("seat_cnt").value = s_cnt;
			
		}else
		{
			alert("Please Increase the Number of Seat");
			
		}
	}else
	{
		document.getElementById("s_"+str).value = "";
		document.getElementById("t_"+str).innerHTML = "<img src='images/seat/available.jpg' width='30' height='30' />";
		s_cnt = parseInt(s_cnt)-1;
		document.getElementById("seat_cnt").value = s_cnt;
	}
}

</script>
<?php 
if(isset($_GET['D']))
{
?>
<table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="80">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><img src="images/screen.png" width="800" height="140" align="absmiddle" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <?php
			$cnt = 1;
			for($i = 1; $i <= $first_row; $i++)
			{
				
			?>
        <td align="center" width="75"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" id="t_<?php echo $i;?>" onclick="sel_seat(<?php echo $i;?>)" style="cursor:pointer"><img src="images/seat/available.jpg" width="30" height="30" /></td>
          </tr>
          <tr>
            <td align="center"><?php echo $i;?>
                    <input name="s_<?php echo $i;?>" type="hidden" id="s_<?php echo $i;?>" size="2" /></td>
          </tr>
        </table></td>
        <?php
			 	if($cnt % 5 == 0 && $cnt % 15 != 0)
				{
					echo "<td width='100'>&nbsp;</td>";
					//$cnt = 0;
				}
			 	if($i % 15 == 0)
				{
					echo "</tr><tr><td height='10' colspan='5'></td></tr><tr>";
				}
				$cnt++;
			 }
			 
			 ?>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <?php
			$xj = 1;
			for($j = $i; $j <= $no_of_seat; $j++)
			{
				//echo $j;
			?>
        <td align="center" width="80"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center" id="t_<?php echo $j;?>" onclick="sel_seat(<?php echo $j;?>)" style="cursor:pointer"><img src="images/seat/available.jpg" width="30" height="30" /></td>
          </tr>
          <tr>
            <td align="center"><?php echo $j;?>
                    <input name="s_<?php echo $j;?>" type="hidden" id="s_<?php echo $j;?>" size="2" /></td>
          </tr>
        </table></td>
        <?php
				if($xj % 17 == 0)
				{
					echo "</tr><tr ><td height='10' colspan='17'></td></tr><tr>";
				}
				$xj++;
			 } 
			 ?>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input name="seat_cnt" type="hidden" id="seat_cnt" value="0" /><input name="tot_seat_cnt" type="hidden" id="tot_seat_cnt" value="<?php echo $no_of_seat;?>" /></td>
  </tr>
</table>
<?php 
}
?>