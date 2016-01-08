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
		else
		{
			$("#serverstats-wrapper").html("Oh no! The request failed with error code "+xmlhttp.status);
		}
	};

	xmlhttp.open("POST","http://tf2ss.googleplusgaming.site.nfoservers.com/index.php", true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	xmlhttp.send($("#s").serialize());

	$("#serverstats-wrapper").html(xmlhttp.responseText);

	$("#sbutton").html("Submit");
}

function toggleState()
{
	if(!($("#pass").attr("type")=="hidden"))
	{
		$("#pass").attr("type","hidden");
	}
	else
	{
		$("#pass").attr("type","password");
	}
}
		

// Also launches submit button on press of enter key
document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('sbutton').addEventListener('click', submit);
  document.getElementById('pass_toggle').addEventListener('click',toggleState);
});

//TODO: This also needs to be fixed
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        submit();
    }
});
