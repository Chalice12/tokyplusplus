<?php
$menu = "ask";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
?>

<h2 style="margin-top: 0; padding-top: 1rem;">Send a question</h2>

<?php
$error = false;
if (isset($_POST["text"])) {
	$text = $_POST["text"];
    if (isset($_POST["sig"]) && $_POST["sig"] == "on") {
		$text = $text . "\n\nSent with toky++ ";
		$sel = array("because i'm better than you", "cause im a purple ninja and im so cool", "aka the greatest thing on planet earth", "and i also stan technoblade", "/hj", "and i selected the 'send with toky++ signature' option for some reason", "owo!!!", "so free advertising for toky++ wooooo", "nerd");
		$text = $text . $sel[array_rand($sel)];
	}
	if (isset($_POST["link"]) && $_POST["link"] == "on") {
		$text = str_replace("https://", "", $text);
		$text = str_replace("http://", "", $text);
	}
	$res = send_question($text);
	if ($res == 1) {
		echo "<p style='text-align: center; color: lightcoral;'>Fail :(</p>";
		$error = "true";
	} else if ($res != $_POST["text"]) {
	    echo "<p style='text-align: center; color: lightcoral;'>Your question might have failed to send? Double check...</p>";
		$error = "true";
	} else {
	    echo "<p style='text-align: center; color: lightgreen;'>Success!</p>";
		@setcookie("past_questions", @$_COOKIE["past_questions"] . "\n" . $_POST["text"], time() + (86400 * 365), "/");
		@$_COOKIE["past_questions"] = @$_COOKIE["past_questions"] . "\n" . $_POST["text"];
	}
	
}
?>

<style>
.askform {
	text-align: center;
}

.askform textarea {
	width: 80%;
	height: 10rem;
	font-size: 1.25rem;
}

.askform input[type="submit"] {
	font-size: 2rem;
	margin-top: 0.5rem;
}
</style>

<form action="/ask/" method="post" class="askform">
<textarea <?php if ($error == "true") echo 'class="textareashake"'; ?> name="text" placeholder="Hi everyone, " required>
<?php if ($error == "true") echo $text; ?>
</textarea><br>
<input type="checkbox" name="sig" id="sig"></input><label for="sig"> Sent with toky++ signature</label><br>
<input type="checkbox" name="link" checked id="link"></input><label for="link"> Fix my links for me</label>
<br>
<input type="submit" value="Send!">
</form>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<h2>Past questions</h2>

<pre style="width: 80%; margin: auto;">
<?php echo isset($_COOKIE['past_questions']) ? $_COOKIE['past_questions'] : "None :("; ?>
</pre>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>