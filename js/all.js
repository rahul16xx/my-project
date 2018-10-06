// JavaScript Document
function chkvalid()
{
	if(document.form1.username.value=='')
	{
		alert("Username Can Not Be Left Blank");
		document.form1.username.focus();
		return false;
	}
	if(document.form1.password.value=='')
	{
		alert("Password Can Not Be Left Blank");
		document.form1.password.focus();
		return false;
	}
	return true;
}

function u_foc(fid)
{
	document.getElementById(fid).focus();
}
function cnt_char(str,id,c)
{
	if(str.length > c)
	{
		alert("Word Count Must Not Greater Than 100");
		document.getElementById(id).select()
	}
}
function cnt_pchar(str,id)
{
	if(str.length < 10)
	{
		alert("Password Must Not Less Than 10");
		document.getElementById(id).select()
	}
}
function chk_null()
{
	if(document.getElementById("group").value == 0)
	{
		alert("Group Can Not Be Null")
		document.getElementById("group").focus();
		return false;
	}
	if(document.getElementById("emp_name").value == "")
	{
		alert("Employee Can Not Be Null")
		document.getElementById("emp_name").focus();
		return false;
	}
	if(document.getElementById("uname").value == "")
	{
		alert("User Name Can Not Be Null")
		document.getElementById("uname").focus();
		return false;
	}
	if(document.getElementById("pass").value == "")
	{
		alert("Password Can Not Be Null")
		document.getElementById("pass").focus();
		return false;
	}
	if(document.getElementById("rpass").value == "")
	{
		alert("Re-type Password Can Not Be Null")
		document.getElementById("rpass").focus();
		return false;
	}
	if(document.getElementById("rpass").value != document.getElementById("pass").value)
	{
		alert("Both Password Must Be Same")
		document.getElementById("rpass").select();
		return false;
	}
	if(document.getElementById("email").value == "")
	{
		alert("Please Insert Email Address !!");
		document.getElementById("email").focus();
		return false;
	}
	if(document.form1.email.value != "")
		{
			var checkEmail = "@.";
			var checkStr = document.form1.email.value;
			var EmailValid = false;
			var EmailAt = false;
			var EmailPeriod = false;
			for (i = 0;  i < checkStr.length;  i++)
			{
					ch = checkStr.charAt(i);
					for (j = 0;  j < checkEmail.length;  j++)
					{
							if (ch == checkEmail.charAt(j) && ch == "@")
							EmailAt = true;
							if (ch == checkEmail.charAt(j) && ch == "." && EmailAt == true)
							EmailPeriod = true;
							if (EmailAt && EmailPeriod)
							break;
							if (j == checkEmail.length)
							break;
					}
			// if both the @ and . were in the string
					if (EmailAt && EmailPeriod)
					{
							EmailValid = true
							break;
					}
			}
			if (!EmailValid)
			{
					alert("The \"Email\" Field Must Contain An \"@\" and a \".\" !");
					document.form1.email.select();
					return (false);
			}
		}
	return true;
}
function chk_nullS()
{
	if(document.getElementById("par_name").value == "")
	{
		alert("Party Name Can Not Be Null")
		document.getElementById("par_name").focus();
		return false;
	}
	if(document.getElementById("par_contno").value == "")
	{
		alert("Party Contact Number Can Not Be Null")
		document.getElementById("par_contno").focus();
		return false;
	}
	/*if(document.getElementById("email").value == "")
	{
		alert("Party Email Address Can Not Be Null")
		document.getElementById("email").focus();
		return false;
	}*/
	if(document.form1.email.value != "")
		{
			var checkEmail = "@.";
			var checkStr = document.form1.email.value;
			var EmailValid = false;
			var EmailAt = false;
			var EmailPeriod = false;
			for (i = 0;  i < checkStr.length;  i++)
			{
					ch = checkStr.charAt(i);
					for (j = 0;  j < checkEmail.length;  j++)
					{
							if (ch == checkEmail.charAt(j) && ch == "@")
							EmailAt = true;
							if (ch == checkEmail.charAt(j) && ch == "." && EmailAt == true)
							EmailPeriod = true;
							if (EmailAt && EmailPeriod)
							break;
							if (j == checkEmail.length)
							break;
					}
			// if both the @ and . were in the string
					if (EmailAt && EmailPeriod)
					{
							EmailValid = true
							break;
					}
			}
			if (!EmailValid)
			{
					alert("The \"Email\" Field Must Contain An \"@\" and a \".\" !");
					document.form1.email.select();
					return (false);
			}
		}
	if(document.getElementById("pro_name").value == 0)
	{
		alert("Product Name Can Not Be Null")
		document.getElementById("pro_name").focus();
		return false;
	}
	if(document.getElementById("pro_slno").value == 0)
	{
		alert("Product Serial Number Can Not Be Null")
		document.getElementById("pro_slno").focus();
		return false;
	}
	
	/*if(document.getElementById("bill_no").value == "")
	{
		alert("Product Bill Number Can Not Be Null")
		document.getElementById("bill_no").focus();
		return false;
	}*/
	
	return true;
}
function chk_nullV()
{
	if(document.getElementById("challan").value == 0)
	{
		alert("Party Challan No. Can Not Be Null")
		document.getElementById("challan").focus();
		return false;
	}
	if(document.getElementById("prod").value == 0)
	{
		alert("Please Select Product")
		document.getElementById("prod").focus();
		return false;
	}
	if(document.getElementById("vendor").value == 0)
	{
		alert("Please Select Vendor")
		document.getElementById("vendor").select();
		return false;
	}
	/*if(document.getElementById("pbill").value == 0)
	{
		alert("Please Enter Purchase Bill")
		document.getElementById("pbill").select();
		return false;
	}*/
	return true;
}

function chk_nullP()
{
	if(document.getElementById("old_pass").value == "")
	{
		alert("Old Password Can Not Be Null")
		document.getElementById("old_pass").focus();
		return false;
	}
	if(document.getElementById("new_pass").value == "")
	{
		alert("New Password Can Not Be Null")
		document.getElementById("new_pass").focus();
		return false;
	}
	if(document.getElementById("renew_pass").value == "")
	{
		alert("Re-Type New Password Can Not Be Null")
		document.getElementById("renew_pass").focus();
		return false;
	}
	if(document.getElementById("new_pass").value != document.getElementById("renew_pass").value)
	{
		alert("Re-Type New Password And New Password Must Be Same")
		document.getElementById("renew_pass").select();
		return false;
	}
	return true;
}

function conf(str)
{
	if(confirm("Really Want To Delete ??") == true)
	{
		location.replace(str);	
	}
}
function ask(str)
{
	if(confirm("Are You Sure ??") == true)
	{
		location.replace(str);	
	}
}
function chk_nullTD()
{
	if(document.getElementById("group").value == 0)
	{
		alert("Please Enter Group Name")
		document.getElementById("group").focus();
		return false;
	}
	
	return true;
}
function chk_nullTRN()
{
	if(document.getElementById("cashier").value == 0)
	{
		alert("Please Select Cashier")
		document.getElementById("cashier").focus();
		return false;
	}
	if(document.getElementById("trans_amnt").value == "")
	{
		alert("Data For Transfer Amount Can Not Be Null")
		document.getElementById("trans_amnt").focus();
		return false;
	}
	return true;
}
function chk_nullCT()
{
	if(document.getElementById("cashier").value == 0)
	{
		alert("Please Select Traller")
		document.getElementById("cashier").focus();
		return false;
	}
	if(document.getElementById("trans_amnt").value == "")
	{
		alert("Data For Transfer Amount Can Not Be Null")
		document.getElementById("trans_amnt").focus();
		return false;
	}
	return true;
}
function chk_nullCH()
{
	
	if(document.getElementById("trans_amnt").value == "")
	{
		alert("Data For Transfer Amount Can Not Be Null")
		document.getElementById("trans_amnt").focus();
		return false;
	}
	return true;
}

function MM_jumpMenu(targ,selObj,restore)
{ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function sendtomenu(str)
{
	location.replace(str);	
}
function get_assign_part(getstr)
{
	//alert(getstr)
	getstr_arr = getstr.split("~~");
	var str = getstr_arr[0];
	var uid = getstr_arr[1];
	var menu = getstr_arr[2];
	var s_part = "";
	if(document.getElementById("add"+str).checked == true || document.getElementById("list"+str).checked == true || document.getElementById("edit"+str).checked == true || document.getElementById("delete"+str).checked == true)
	{
		var s_part = 2;
	}
	if(document.getElementById("add"+str).checked == true)
	{
		s_part = s_part+":"+1;	
	}
	if(document.getElementById("edit"+str).checked == true)
	{
		s_part = s_part+":"+3;	
	}
	if(document.getElementById("delete"+str).checked == true)
	{
		s_part = s_part+":"+4;	
	}
	var URL = "menu_right.php?menu="+menu+"&U="+uid+"&SP="+s_part+"&MM="+str;
	//alert(URL);
	location.replace(URL);
}
function get_revoke_part(getstr)
{
	getstr_arr = getstr.split("~~");
	var str = getstr_arr[0];
	var uid = getstr_arr[1];
	var menu = getstr_arr[2];
	getstr_r_part_arr = s_part.split(":");
	var list = getstr_r_part_arr[0];
	var add = getstr_r_part_arr[1];
	var edit = getstr_r_part_arr[2];
	var del = getstr_r_part_arr[3];
	if(document.getElementById("add"+str).checked == true)
	{
		
	}
	if(document.getElementById("edit"+str).checked == true)
	{
		
	}
	if(document.getElementById("delete"+str).checked == true)
	{
		
	}
	var URL = "menu_right.php?menu="+menu+"&U="+uid+"&SP="+s_part+"&MM="+str;
	location.replace(URL);
}
function get_branch(mid)
{
	var zid = document.getElementById("zone").value;
	location.replace("saving_account.php?menu="+mid+"&zid="+zid);
}
function get_acc(z,m,fp,c)
{
	var brid = document.getElementById("br_name").value;
	if(z.length == 1)
	{
		z = "000"+z;	
	}else
	{
		z = "00"+z;	
	}	
	if(brid.length == 1)
	{
		brid = "000"+brid;	
	}else
	{
		brid = "00"+brid;	
	}
	if(c.length == 1)
	{
		c = "000"+c;	
	}else
	{
		c = "00"+c;	
	}
	document.getElementById("acc_no").value = fp+z+brid+c;
}
function card_next(str1,str2)
{
	valstr1 = document.getElementById(str1).value;
	if(valstr1.length == 4)
	{
		document.getElementById(str2).focus();
	}
}
function sameas()
{
	if(document.getElementById("sm").checked == true)
	{
		document.getElementById("per_add1").value = document.getElementById("pre_add1").value;
		document.getElementById("per_add1").disabled = true;
		document.getElementById("per_add2").value = document.getElementById("pre_add2").value;
		document.getElementById("per_add2").disabled = true;
		document.getElementById("per_city").value = document.getElementById("pre_city").value;
		document.getElementById("per_city").disabled = true;
		document.getElementById("per_state").value = document.getElementById("pre_state").value;
		document.getElementById("per_state").disabled = true;
		document.getElementById("per_pin").value = document.getElementById("pre_pin").value;
		document.getElementById("per_pin").disabled = true;
	}else
	{
		document.getElementById("per_add1").value = "";
		document.getElementById("per_add1").disabled = false;
		document.getElementById("per_add2").value = "";
		document.getElementById("per_add2").disabled = false;
		document.getElementById("per_city").value = "";
		document.getElementById("per_city").disabled = false;
		document.getElementById("per_state").value = "";
		document.getElementById("per_state").disabled = false;
		document.getElementById("per_pin").value = ""
		document.getElementById("per_pin").disabled = false;
	}
}
function getSelected(opt) {
      var selected = new Array();
      var index = 0;
      for (var intLoop=0; intLoop < opt.length; intLoop++) {
         if (opt[intLoop].selected) {
            index = selected.length;
            selected[index] = new Object;
            selected[index].value = opt[intLoop].value;
            selected[index].index = intLoop;
         }
      }
      return selected;
   }
   function outputSelected(opt) {
            var sel = getSelected(opt);
            var strSel = "";
            for (var item in sel) 
			{
               if(strSel == "")
			   {
				   strSel = sel[item].value;
			   }else
			   {
			   		strSel =  strSel+"**"+sel[item].value;
			   }
			}
            //alert("Selected Items:\n" + strSel);
			return strSel;
         }

function chk_unique()
{
	//var card1 = document.getElementById("challan").value;
	var card1 = outputSelected(document.getElementById("challan").options);
	//alert(card1);
	if (card1.length > 0)
	{ 
		var url="chk_unique.php?R="+card1;
		xmlHttp=GetXmlHttpObject1(showArea)
		xmlHttp.open("GET", url , true)
		xmlHttp.send(null)
	} 
}
function showArea() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		//alert(xmlHttp.responseText);
		if(xmlHttp.responseText)
		{
			document.getElementById("areaHint").innerHTML=xmlHttp.responseText; 
		}
		
	} 
} 
function get_chk_usr(str)
{
	if(str != "")
	{
		var url="chk_usr.php?R="+str;
		xmlHttp=GetXmlHttpObject1(showUsr)
		xmlHttp.open("GET", url , true)
		xmlHttp.send(null)
	}
}
function showUsr() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		//alert(xmlHttp.responseText);
		if(xmlHttp.responseText > 0)
		{
			alert("Menu Already Exists.");
			document.getElementById("menu_name").select();
		}
		
	} 
} 
function chk_avail_amnt(a,b)
{
	var now_amnt = document.getElementById(a).value;
	var avail_amnt = document.getElementById(b).value;
	
	if(avail_amnt == "" || avail_amnt == 0)
	{
			alert("Available Amount Is NULL");
			document.getElementById(a).value = "";
	}
	if(parseInt(now_amnt) > parseInt(avail_amnt))
	{
		alert("Amount To Be Transfered Must Be Less Than Or Equal To Available Chest Balance");
		document.getElementById(a).select();
	}
}
function showhide(a,b)
{
	if(document.getElementById(b).style.display == "block")
	{
			document.getElementById(b).style.display = "none";
	}
	document.getElementById(a).style.display = "block";
}
function chk_showhide(a,b)
{
	if(document.getElementById(a).checked == true)
	{
			document.getElementById(b).style.display = "block";
	}else
	{
		document.getElementById(b).style.display = "none";
	}
}
function take()
{
	var took = "";
	if(document.getElementById("adaptor").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("adaptor").value;
		}else
		{
			took = 	took+","+document.getElementById("adaptor").value;	
		}
	}
	if(document.getElementById("memory_card").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("memory_card").value;
		}else
		{
			took = 	took+","+document.getElementById("memory_card").value;	
		}
	}
	if(document.getElementById("vga").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("vga").value;
		}else
		{
			took = 	took+","+document.getElementById("vga").value;	
		}
	}
	if(document.getElementById("sound_card").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("sound_card").value;
		}else
		{
			took = 	took+","+document.getElementById("sound_card").value;	
		}
	}
	if(document.getElementById("tv_tuner").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("tv_tuner").value;
		}else
		{
			took = 	took+","+document.getElementById("tv_tuner").value;	
		}
	}
	if(document.getElementById("modem").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("modem").value;
		}else
		{
			took = 	took+","+document.getElementById("modem").value;	
		}
	}
	if(document.getElementById("lan").checked == true)
	{
		if(took == "")
		{
			took = 	document.getElementById("lan").value;
		}else
		{
			took = 	took+","+document.getElementById("lan").value;	
		}
	}
	document.getElementById("alltype").value = took;
}
function get_det(s)
{
	
	for(var i = 0; i < document.form1.ch.length; i++)
	{
		
		if(document.form1.ch[i].checked == true)	
		{
			var rad_val = document.form1.ch[i].value;
			location.replace("service_report.php?menu="+s+"&ch="+rad_val);
		}
	}
}
//######################################################################//
function GetXmlHttpObject1(handler)
{ 
var objXmlHttp=null

if (navigator.userAgent.indexOf("Opera")>=0)
{
alert("This example doesn't work in Opera") 
return 
}
if (navigator.userAgent.indexOf("MSIE")>=0)
{ 
var strName="Msxml2.XMLHTTP"
if (navigator.appVersion.indexOf("MSIE 5.5")>=0)
{
strName="Microsoft.XMLHTTP"
} 
try
{ 
objXmlHttp=new ActiveXObject(strName)
objXmlHttp.onreadystatechange=handler 
return objXmlHttp
} 
catch(e)
{ 
alert("Error. Scripting for ActiveX might be disabled") 
return 
} 
} 
if (navigator.userAgent.indexOf("Mozilla")>=0)
{
objXmlHttp=new XMLHttpRequest()
objXmlHttp.onload=handler
objXmlHttp.onerror=handler 
return objXmlHttp
}
} 
//#############################################################################//