<?php
$menu = "settings";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
?>

<style>
p {
text-align: center;
}
button {
text-align: center;
}
</style>

<h2 style="margin-top: 0; padding-top: 1rem;">Dark mode</h2>
<p id="darkmodep">Bet you know what this does.<br><br>
<button id="darkmode" onclick="toggleDark()"><?php echo @$_COOKIE["dark"] == "true" ? "Toggle off" : "Toggle on"; ?></button>
</p>

<h2>Debug mode</h2>
<p>Shows some (hidden) messages for the developer, or a nerd like you :)<br><br>
<button id="debugmode" onclick="toggleDebug()"><?php echo @$_COOKIE["debug"] == "true" ? "Toggle off" : "Toggle on"; ?></button>
</p>

<h2>Reset identity</h2>
<p>Wanna start fresh? This button will turn you into a new anon, and remove all your chat logs, along with your blocklist.<br><br>
<button style="color: red;" onclick="reset()">Reset</button>
</p>

<script>
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function toggleDark() {
	if (getCookie("dark") == "true") {
		setCookie("dark", "false", 365);
	} else {
		setCookie("dark", "true", 365);
	}
	location.reload();
}

function toggleDebug() {
	if (getCookie("debug") == "true") {
		setCookie("debug", "false", 365);
	} else {
		setCookie("debug", "true", 365);
	}
	location.reload();
}

function reset()
{   
    function deleteCookie(cookiename)
    {
        var d = new Date();
        d.setDate(d.getDate() - 1);
        var expires = ";expires="+d;
        var name=cookiename;
        //alert(name);
        var value="";
        document.cookie = name + "=" + value + expires + "; path=/";                    
    }
	deleteCookie("past_questions");
	deleteCookie("toky_auth_unused");
	deleteCookie("toky_cookie");
	deleteCookie("blocklist");
    window.location = "/"; // TO REFRESH THE PAGE
}
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>