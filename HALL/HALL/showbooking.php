<?php
include "includes/config.php";
include "connection/connection.php";

$AS = $_GET['AS'];

?>
<style>
.box{
border-radius:5px;
color:#333333;
overflow:hidden;
}
</style>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="45%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td width="50%">&nbsp;</td>
  </tr>
  <?php
  $AS_arr = explode("@",$AS);
  for($asa = 0; $asa < count($AS_arr); $asa++)
  {
  	$this_seat = $AS_arr[$asa];
  ?>
  <tr>
    <td height="30" align="right" style="color:#CCCCCC; font-family:Cursive; font-weight:bold;">Customer Name <?php echo $asa+1;?> </td>
    <td align="center" style="color:#CCCCCC;">:</td>
    <td align="left"><input name="p<?php echo $asa+1;?>" type="text" class="box" id="p<?php echo $asa+1;?>" />
        <input name="se<?php echo $asa+1;?>" type="hidden" id="se<?php echo $asa+1;?>" value="<?php echo $this_seat;?>" /></td>
  </tr>
  <?php
  }
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="Submit" name="Submit" src="images/Book-Now-Button-PNG-Photos.png" width="80" height="30" value="Book" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="ccnt" type="hidden" id="ccnt" value="<?php echo count($AS_arr);?>" /></td>
  </tr>
</table>
