<?php
if($_SESSION['login_id'] == "")
{
	echo "<script>
				alert('Please Login !!')
				location.replace('index.php');
			</script>";
}else
{
	$ses_menu_rights = $_SESSION['menu_right'];
	if($ses_menu_rights == "")
	{
		echo "<script>
				alert('Menus Are Not Assigned For This User. Please Contact Administrator !!')
				location.replace('logout.php');
			</script>";
	}else
	{
		$assigned_menu = array();
		$assigned_menusub = array();
		$ses_menu_rights_arr = explode("@@",$ses_menu_rights);
		foreach($ses_menu_rights_arr as $this_menusub)
		{
			array_push($assigned_menusub,$this_menusub);
			list($M,$S) = explode("#",$this_menusub);
			array_push($assigned_menu,$M);
			
			if($M == $_GET['menu'])
			{
				$sub_Arr = explode(":",$S);
				foreach($sub_Arr as $this_sub)
				{
					switch($this_sub)
					{
						case 1:
								$AA = 1;
						break;
						case 2:
								$AL = 1;
						break;
						case 3:
								$AE = 1;
						break;
						case 4:
								$AD = 1;
						break;
					}
				}
			}
		}
	}
	/*echo "Avijit : ";
	print_r($assigned_menusub);
	echo "<br>Datta :";
	print_r($assigned_menu);*/
	
}
?>