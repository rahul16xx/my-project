// JavaScript Document
function chk_book()
{
	var ccnt = document.getElementById("ccnt").value;
	var flag = 1;
	for(var x = 1; x <= ccnt; x++)
	{
		var this_c = document.getElementById("p"+x).value;
		if(this_c != "")
		{
			flag = parseInt(flag)+1;	
		}
	}
	if(flag < ccnt)
	{
		alert("Please Provide All Customer Name")
		return false;
	}
}
function null_chk()
{
	if(document.getElementById("uname").value == "")
	{
		alert("Please Enter User Name");
		document.getElementById("uname").focus();
		return false;
	}
	if(document.getElementById("pass").value == "")
	{
		alert("Please Enter Password");
		document.getElementById("pass").focus();
		return false;
	}
	if(document.getElementById("rpass").value == "")
	{
		alert("Please Enter Confirm Password");
		document.getElementById("rpass").focus();
		return false;
	}
	if(document.getElementById("pass").value!=document.getElementById("rpass").value)
	{
		alert("Passwords Do Not Match");
    	document.getElementById("pass").value==document.getElementById("rpass").value;
   		return false;
	}
	if(document.getElementById("email").value == "")
	{
		alert("Please Enter Your Email Id");
		document.getElementById("email").focus();
		return false;
	}
	
	if(document.getElementById("contact").value == "")
	{
		alert("Please Enter Your Contact Number");
		document.getElementById("contact").focus();
		return false;
	}
	
}
function getseat()
{
	var mdate = document.form1.movdate.value;
	var mov = document.getElementById("mov").value;
	var mul = document.getElementById("mp").value;
	var se = document.getElementById("seat").value;
	
	
	var url="get_seat.php?D="+mdate+"&M="+mov+"&T="+mul+"&S="+se;
	//alert url;
	xmlHttp=GetXmlHttpObject1(showArea)
	xmlHttp.open("GET", url , true)
	xmlHttp.send(null)
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
function show_booking()
{
	var all_seat = "";
	var tot = document.getElementById("tot_seat_cnt").value;
	for(var x = 1; x <= tot; x++)
	{
		var sn = document.getElementById("s_"+x).value;
		if(sn != "")
		{
			if(all_seat == "")
			{
				all_seat = sn;	
			}else
			{
				all_seat = all_seat+"@"+sn;	
			}
		}
	}
	//alert(all_seat)
	if(all_seat != "")
	{
		var url="showbooking.php?AS="+all_seat;
		//alert(url)
		xmlHttp=GetXmlHttpObject1(showSeat)
		xmlHttp.open("GET", url , true)
		xmlHttp.send(null)
	}else
	{
		alert("Please Select Atleast 1 Seat");
	}/**/
	//alert(tot)
}
function showSeat() 
{ 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
	{ 
		//alert(xmlHttp.responseText);
		if(xmlHttp.responseText)
		{
			document.getElementById("sbooking").innerHTML=xmlHttp.responseText; 
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