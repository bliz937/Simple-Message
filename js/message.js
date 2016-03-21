function loadMsg(msgid)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById("body").innerHTML = xmlhttp.responseText;

		$("#nxtBtn").click(function() {
			loadMsg($("#nxtBtn").val());
		});

		$("#prvBtn").click(function() {
			loadMsg($("#prvBtn").val());
		});
	}
    }

    xmlhttp.open("POST", "ajax.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("viewMsg=" + msgid);

}

function btnEvt()
{
	$("#nxtBtn").click(function() {
		loadMsg($("#nxtBtn").val());
	});

	$("#prvBtn").click(function() {
		loadMsg($("#prvBtn").val());
	});
}

$(document).ready(function () {

	btnEvt();
	
	$("#bodyNav").click(function() {

		if($("#bodyNav").attr("href") == "#post")
		{
		    //$("#body").load("html/message.post.html");
		    var xmlhttp = new XMLHttpRequest();
		    xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("body").innerHTML = xmlhttp.responseText;
				btnEvt();
				    $("#postBtn").click(function() {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
					    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						document.getElementById("postDiv").innerHTML = xmlhttp.responseText;
					    }
					}
			    
				    xmlhttp.open("POST", "ajax.php", true);
				    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				    xmlhttp.send("post=" + $("#postBody").val());
				    });
			}
		    }

		    xmlhttp.open("POST", "ajax.php", true);
		    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    xmlhttp.send("view=" + $("#bodyNav").attr("href").replace("#", ""));
		    $("#bodyNav").attr("href", "#view");
		    $("#bodyNav").text("View");
				
		} else {               
		    var xmlhttp = new XMLHttpRequest();
		    xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				document.getElementById("body").innerHTML = xmlhttp.responseText;
				btnEvt();
				$("#bodyNav").attr("href", "#post");
				$("#bodyNav").text("Post");
			}
		    }

		    xmlhttp.open("POST", "ajax.php", true);
		    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    xmlhttp.send("view=" + $("#bodyNav").attr("href").replace("#", ""));
		}
		
	});
});
