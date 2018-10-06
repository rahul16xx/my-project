<?php
				$get_menu_sql = "select menu_right from login_master where login_id = '$user_id'";
				$get_menu_rec = mysql_query($get_menu_sql);
				$get_menu_num = mysql_num_rows($get_menu_rec);
				$get_menu_res = mysql_fetch_assoc($get_menu_rec);
				$send_ids = $res['menu_id']."~~".$_GET['U']."~~".$_GET['menu'];
				if($get_menu_res['menu_right'] == "")
				{ ////////////////////////////////////////////////////////////////////////////////////////// if 1.0 started
					$set_img = "<a href='#' onclick=\"get_assign_part('".$send_ids."')\" title='Click Here To Assign'><img src='images/green.JPG' width='24' height='24' border=0 /></a>";
				}else //////////////////////////////////////////////////////////////else 1.0 started
				{
					$got_menu_right = $get_menu_res['menu_right']; /////////// menu right detail from db 
					
					$got_menu_right_arr = explode("@@",$got_menu_right); ///// exploding by @@ for main block
					#print_r($got_menu_right_arr);
					for($gmra = 0; $gmra < count($got_menu_right_arr); $gmra++) ///////////////////////////// for loop to get individual blocks
					{
						$this_first_block = $got_menu_right_arr[$gmra]; /////// this loop block
						
						list($mm,$sm) = explode("#",$this_first_block); ////// exploding this block for main menu & sub menu
						#echo "<br>".$mm."<br>";
						if($mm == $res['menu_id']) ///////////////////////////////////////////////////////// if block to check main menu
						{
							$sm_arr = explode(":",$sm);
							$sm_arr_cnt = count($sm_arr);
							if($sm_arr_cnt == 4)
							{ ////////////////////////////////////////////////////////////////////////////// if block for gray :: red
								$menu_assign_avail = 1;
								break;
							}else
							{ ////////////////////////////////////////////////////////////////////////////// else block for green :: red
								$menu_assign_avail = 2;
								break;
							}
						}else
						{ ////////////////////////////////////////////////////////////////////////////////// else block for green :: gray
							$menu_assign_avail = 3;
						}
					} ////////////////////////////////////////////////////////////////////////////////////// for closed
					#echo $menu_assign_avail."<hr>";
					switch($menu_assign_avail)
					{ ////////////////////////////////////////////////////////////////////////////////////// switch for setting images
						case 1:
							$set_img = "<a href='#' onclick=\"get_assign_part('".$send_ids."')\" title='Click Here To Revoke'><img src='images/red.JPG' width='24' height='24' border=0 /></a>";
						break;
						case 2:
							$set_img = "<a href='#' onclick=\"get_assign_part('".$send_ids."')\" title='Click Here To Assign'><img src='images/green.JPG' width='24' height='24' border=0 /></a>";
						break;
						case 3:
							$set_img = "<a href='#' onclick=\"get_assign_part('".$send_ids."')\" title='Click Here To Assign'><img src='images/green.JPG' width='24' height='24' border=0 /></a>";
						break;
					} ////////////////////////////////////////////////////////////////////////////////////// switch closed
					
				} ////////////////////////////////////////////////////////////////// else 1.0 closed
?>