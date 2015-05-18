function submit()
{
	//TODO: Make this actually work
	$("#sbutton").html("Querying server...");
	var xmlhttp;

	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			$("#serverstats-wrapper").html(xmlhttp.responseText);
		}
	};

	xmlhttp.open("GET","http://tf2ss.googleplusgaming.site.nfoservers.com/?"+ $("#s").serialize(), true);
	xmlhttp.send();

	$("#serverstats-wrapper").html(xmlhttp.responseText);

	$("#sbutton").html("Submit");
}

function toggleState()
{
	if(document.getElementById("pass").hasAttribute("type","hidden") == false)
	{
		document.getElementById("pass").setAttribute("type","hidden");
	}
	else
	{
		document.getElementById("pass").removeAttribute("type","hidden");
	}
}
		

// Also launches submit button on press of enter key
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('button')[0].addEventListener('click', submit);
  document.querySelectorAll('input')[2].addEventListener('click',toggleState);
});
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        submit();
    }
});
