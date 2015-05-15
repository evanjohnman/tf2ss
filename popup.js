
function submit(){

	document.getElementById("sbutton").innerHTML="Querying server...";
	var xmlhttp;

	if (window.XMLHttpRequest)
{
		// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();

	}
else{
	// code for IE6, IE5
	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("serverstats-wrapper").innerHTML=xmlhttp.responseText;
		}
	}

	xmlhttp.open("GET","http://sw.googleplusgaming.site.nfoservers.com/PHP-Source-Query-Class/RconExample.php?"+ $("#s").serialize(), true);
		xmlhttp.send();

	$("#serverstats-wrapper").html(xmlhttp.responseText);

	document.getElementById("sbutton").innerHTML="Submit";
}

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('button').addEventListener('click', submit);
});
$("input").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        submit();
    }
});