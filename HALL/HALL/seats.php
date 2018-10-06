<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script>
function sel_seat(str)
{
	var sval = document.getElementById("s_"+str).value;
	
	if(sval == "" || sval == 0)
	{
		document.getElementById("s_"+str).value = str;
		document.getElementById("t_"+str).innerHTML = "<img src='images/seat/2.jpg' width='50' height='50' />";
	}else
	{
		document.getElementById("s_"+str).value = "";
		document.getElementById("t_"+str).innerHTML = "<img src='images/seat/1.jpg' width='50' height='50' />";
	}
}
</script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><img src="images/screen.png" width="1024" height="142" align="absmiddle" /></td>
        </tr>
		<tr>
		<td>&nbsp;</td>
		</tr>
        <tr>
          <td><table width="400" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
			<?php
			$cnt = 1;
			for($i = 1; $i <= 60; $i++)
			{
				
			?>
              <td align="center" width="75"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center" id="t_<?php echo $i;?>" onclick="sel_seat(<?php echo $i;?>)" style="cursor:pointer"><img src="images/seat/1.jpg" width="50" height="50" /></td>
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
			for($j = $i; $j <= 77; $j++)
			{
			?>
              <td align="center" width="80">
			  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
				  <tr>
					<td align="center" id="t_<?php echo $j;?>" onclick="sel_seat(<?php echo $j;?>)" style="cursor:pointer"><img src="images/seat/1.jpg" width="50" height="50" /></td>
				  </tr>
				  <tr>
					<td align="center"><?php echo $j;?>
						<input name="s_<?php echo $j;?>" type="hidden" id="s_<?php echo $j;?>" size="2" /></td>
				  </tr>
				</table>			  </td>
			  <?php
			 } 
			 ?>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
			
          <td width="80" align="right"><img src="images/seat/soldout.png" width="17" height="17" />Sold Out Seats <img src="images/seat/available.png" width="17" height="17" />Available Seats <img src="images/seat/selected.png" width="17" height="17" />Selected Seats </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
        </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
