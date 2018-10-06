// JavaScript Document
function query_chk()
{
	if(document.getElementById("name").value == "")
	{
		alert("Please Enter Your Name");
		document.getElementById("name").focus();
		return false;
	}
	if(document.getElementById("email").value == "")
	{
		alert("Please Enter Your Email ID");
		document.getElementById("email").focus();
		return false;
	}
	if(document.getElementById("query").value == "")
	{
		alert("Please Enter Your Query");
		document.getElementById("query").focus();
		return false;
	}
	
}