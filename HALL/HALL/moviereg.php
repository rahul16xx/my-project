<?php
session_start();
include "includes/config.php";
include "connection/connection.php";

if(isset($_POST['Submit']))
{
	$movname=$_POST['movname'];
	$lang=$_POST['lang'];
	$abtmov=$_POST['abtmov'];
	$status=$_POST['status'];
	$date=$_POST['movdate'];
	$time=$_POST['time'];
	if($_POST['Submit'] == "Submit")
	{
		$movsql = "insert into movie_master(mov_name,mov_lang,mov_date,mov_time,mov_abt,mov_status) values('$movname','$lang','$date','$time','$abtmov','$status')";
		$movrec = mysql_query($movsql);
		if($movrec)
		{
			echo "<script>
				alert('Movie Successfully Added')
				location.replace('moviereg.php?')
				</script>";
		}
	}elseif($_POST['Submit'] == "Update")
	{
		$pk = $_POST['pk'];
		$usql = "update movie_master set mov_name='$movname',mov_lang='$lang',mov_date='$date',mov_time='$time',mov_status='$status',mov_abt='$abtmov' where mov_id='$pk'";
		$urec = mysql_query($usql);
		if($urec)
		{
			echo "<script>
				alert('Movie Details Updated')
				location.replace('moviereg.php?')
				</script>";
		}
	}
}
if(isset($_GET['E']))
{
	$E = $_GET['E'];
	$esql = "select * from movie_master where mov_id='$E'";
	$erec = mysql_query($esql);
	$eres = mysql_fetch_assoc($erec);
}else if(isset($_GET['D']))
{
	$D = $_GET['D'];
	$dsql = "delete from movie_master where mov_id='$D'";
	$drec = mysql_query($dsql);
	if($drec)
		{
			echo "<script>
				alert('Deleted Successfully')
				location.replace('moviereg.php?')
				</script>";
		}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="js/calendarDateInput.js"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $title;?></title>
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
</head>
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
    <td><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return null_chk()">
      <table width="99%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td colspan="3" style="font-size:12px; color:#CCCCCC; font-weight:bold;" align="center">MOVIE ENTRY</td>
              </tr>
            <tr>
              <td colspan="3" align="right">&nbsp;</td>
              </tr>
            <tr style="color:#CCCCCC">
              <td width="41%" align="right" style="font-family:Cursive;">NAME </td>
              <td width="4%" align="center">:</td>
              <td align="left"><input name="movname" type="text" id="movname" value="<?php echo @$eres['mov_name'];?>" class="box"/></td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">DATE </td>
              <td align="center">:</td>
              <td align="left"><script>DateInput('movdate', true, 'YYYY-MM-DD')</script></td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">TIME</td>
              <td align="center">:</td>
              <td align="left"><input name="time" type="time" id="time" class="box"/></tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">LANGUAGE </td>
              <td align="center">:</td>
              <td align="left">
                  <input type="radio" name="lang" value="ENGLISH" style="font-family:Cursive;" <?php if ($eres['mov_lang'] == "ENGLISH"){echo "checked";} ?> />
                    ENGLISH
                  <input type="radio" name="lang" value="HINDI" style="font-family:Cursive;" <?php if ($eres['mov_lang'] == "HINDI"){echo "checked";} ?>/>
                    HINDI
                  <input type="radio" name="lang" value="BENGALI" style="font-family:Cursive;" <?php if ($eres['mov_lang'] == "BENGALI"){echo "checked";} ?>/>
                    BENGALI
                  <input type="radio" name="lang" value="TAMIL" style="font-family:Cursive;" <?php if ($eres['mov_lang'] == "TAMIL"){echo "checked";} ?>/>
                    TAMIL              </td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" style="font-family:Cursive;">STATUS </td>
              <td align="center">:</td>
              <td align="left"><input type="radio" name="status" value="1" <?php if ($eres['mov_status'] == "1"){echo "checked";} ?>/>
                ACTIVE
                <input type="radio" name="status" value="0" <?php if ($eres['mov_status'] == "0"){echo "checked";} ?>/>
                INACTIVE </td>
            </tr>
            <tr style="color:#CCCCCC">
              <td align="right" valign="top" style="font-family:Cursive;">ABOUT </td>
              <td align="center" valign="top">:</td>
              <td align="left"><textarea name="abtmov" cols="50" rows="5" id="abtmov" class="box"><?php echo @$eres['mov_abt'];?></textarea></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left"><input type="submit" class="btn" name="Submit" <?php if(isset($_GET['E'])){echo "value='Update'";}else{?>value="Submit"<?php }?>/>
                  <input name="Reset" type="reset" id="Reset" class="btn" value="Reset" />
                  <input name="pk" type="hidden" id="pk" value="<?php echo $_GET['E'];?>" /></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="left">&nbsp;</td>
            </tr>
            <?php 
	  $fsql = "select * from movie_master";
	  $frec = mysql_query($fsql);
	  $fnum = mysql_num_rows($frec);
	  
	  if($fnum > 0)
	  {
	  ?>
            <tr>
              <td height="30" colspan="3" align="center"><table width="95%" border="0" cellspacing="1" cellpadding="1">
                  <tr style="color:#CCCCCC">
                    <td width="5%" align="center">SL NO. </td>
                    <td width="10%">NAME</td>
                    <td width="5%">DATE</td>
                    <td width="5%">TIME</td>
                    <td width="10%">LANGUAGE </td>
                    <td width="5%">ABOUT</td>
                    <td width="5%" align="center">STATUS</td>
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
                    <td><?php echo $fres['mov_name'];?></td>
                    <td><?php echo $fres['mov_date'];?></td>
                    <td><?php echo $fres['mov_time'];?></td>
                    <td><?php echo $fres['mov_lang'];?></td>
                    <td><?php echo $fres['mov_abt'];?></td>
                    <td align="center"><?php if($fres['mov_status'] == 1){echo "Active";}else{echo "Inactive";}?></td>
                    <td align="center" valign="middle"><a href="moviereg.php?E=<?php echo $fres['mov_id'];?>" style="text-decoration:none; color:#CCCCCC;">EDIT</a>|<a onclick="return confirm('Are You Sure?')" href="moviereg.php?D=<?php echo $fres['mov_id'];?>" style="text-decoration:none; color:#CCCCCC;">DELETE</a></td>
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
      </table>
    </form></td>
  </tr>
  <tr>
    <td><?php include "includes/footer.php";?></td>
  </tr>
</table>
</body>
</html>
